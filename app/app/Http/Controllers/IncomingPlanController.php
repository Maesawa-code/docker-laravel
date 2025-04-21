<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomingPlan;
use App\Store;
use App\Product;
use App\Inventory;
use Illuminate\Support\Facades\Auth;

class IncomingPlanController extends Controller
{
    public function index(Request $request)
    {
        $userStoreId = Auth::user()->store_id;

        $query = IncomingPlan::with('store', 'product')->where('store_id', $userStoreId);

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->whereHas('product', function ($q2) use ($keyword) {
                    $q2->where('product_name', 'like', "%{$keyword}%");
                });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('planned_date', '>=', $request->date);
        }

        $incomingPlanGroups = $query->orderBy('planned_date', 'desc')
            ->get()
            ->groupBy(function ($plan) {
                return $plan->planned_date . '_' . $plan->store->name;
            });

        return view('incoming_plans.index', compact('incomingPlanGroups'));
    }

    public function registerForm()
    {
        $products = Product::all();
        return view('incoming_plans.register', compact('products'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'plans' => 'required|json',
        ]);

        $plans = json_decode($request->plans, true);
        $storeId = Auth::user()->store_id;
        $plannedDate = now()->addDays(3)->toDateString();

        foreach ($plans as $plan) {
            IncomingPlan::create([
                'store_id' => $storeId,
                'product_id' => $plan['product_id'],
                'planned_date' => $plannedDate,
                'quantity' => $plan['quantity'],
                'weight' => $plan['weight'],
            ]);
        }

        return redirect()->route('incoming-plans.index')->with('success', '入荷予定を登録しました');
    }

    public function show($date, $store_id)
    {
        if ($store_id != Auth::user()->store_id) {
            abort(403, '自店舗の入荷予定しか閲覧できません。');
        }

        $plans = IncomingPlan::with('product', 'store')
            ->whereDate('planned_date', $date)
            ->where('store_id', $store_id)
            ->get();

        $store = Store::findOrFail($store_id);

        return view('incoming_plans.show', compact('plans', 'date', 'store'));
    }

    public function edit($id)
    {
        $plan = IncomingPlan::with('product')->findOrFail($id);

        if ($plan->store_id != Auth::user()->store_id) {
            abort(403, '自店舗の入荷予定しか編集できません。');
        }

        return view('incoming_plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $plan = IncomingPlan::findOrFail($id);

        if ($plan->store_id != Auth::user()->store_id) {
            abort(403, '自店舗の入荷予定しか更新できません。');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $plan->quantity = $request->quantity;
        $plan->weight = $plan->product->weight * $request->quantity;
        $plan->save();

        return redirect()->route('incoming-plans.show', ['date' => $plan->planned_date, 'store' => $plan->store_id])
            ->with('success', '数量を更新しました');
    }

    public function destroy($id)
    {
        $plan = IncomingPlan::findOrFail($id);

        if ($plan->store_id != Auth::user()->store_id) {
            abort(403, '自店舗の入荷予定しか削除できません。');
        }

        $plan->delete();

        return redirect()->route('incoming-plans.show', ['date' => $plan->planned_date, 'store' => $plan->store_id])
            ->with('success', '入荷予定を削除しました');
    }

    public function confirm($id)
    {
        $targetPlan = IncomingPlan::findOrFail($id);

        if ($targetPlan->store_id != Auth::user()->store_id) {
            abort(403, '自店舗の入荷予定しか確定できません。');
        }

        $plans = IncomingPlan::whereDate('planned_date', $targetPlan->planned_date)
            ->where('store_id', $targetPlan->store_id)
            ->get();

        foreach ($plans as $plan) {
            if ($plan->is_confirmed) continue;

            $inventory = Inventory::where('store_id', $plan->store_id)
                ->where('product_id', $plan->product_id)
                ->first();

            if ($inventory) {
                $inventory->quantity += $plan->quantity;
                $inventory->weight += $plan->weight;
                $inventory->save();
            } else {
                Inventory::create([
                    'store_id' => $plan->store_id,
                    'product_id' => $plan->product_id,
                    'quantity' => $plan->quantity,
                    'weight' => $plan->weight,
                ]);
            }

            $plan->is_confirmed = true;
            $plan->save();
        }

        return back()->with('success', '入荷を確定し、在庫に反映しました');
    }
}
