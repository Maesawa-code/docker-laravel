<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomingPlan;
use App\Store;
use App\Product;
use Illuminate\Support\Facades\Auth;

class IncomingPlanController extends Controller
{
    public function index()
    {
        $incomingPlanGroups = IncomingPlan::with('store', 'product')
            ->orderBy('planned_date', 'desc')
            ->get()
            ->groupBy(function ($plan) {
                return $plan->planned_date . '_' . $plan->store->name;
            });

        return view('incoming_plans.index', compact('incomingPlanGroups'));
    }

    public function registerForm()
    {
        $stores = Store::all();
        $products = Product::all();
        return view('incoming_plans.register', compact('stores', 'products'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'plans' => 'required|json',
        ]);

        $plans = json_decode($request->plans, true);
        $storeId = Auth::user()->store_id;
        $today = now()->toDateString();

        foreach ($plans as $plan) {
            IncomingPlan::create([
                'store_id' => $storeId,
                'product_id' => $plan['product_id'],
                'planned_date' => $today,
                'quantity' => $plan['quantity'],
                'weight' => $plan['weight'],
            ]);
        }

        return redirect()->route('incoming-plans.index')->with('success', '入荷予定を登録しました');
    }

    public function show($date, $store_id)
    {
        $plans = IncomingPlan::with('product', 'store')
            ->whereDate('planned_date', $date)
            ->where('store_id', $store_id)
            ->get();

        $store = Store::findOrFail($store_id);

        return view('incoming_plans.show', [
            'plans' => $plans,
            'date' => $date,
            'store' => $store,
        ]);
    }
}
