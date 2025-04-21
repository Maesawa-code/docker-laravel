<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\IncomingPlan;

class InventoryController extends Controller
{
    // 自店舗のみの在庫一覧
    public function index(Request $request)
    {
        $keyword = null; 
        $query = Inventory::with(['product', 'store'])->whereNull('deleted_at');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->whereHas('product', function ($q2) use ($keyword) {
                    $q2->where('product_name', 'LIKE', "%{$keyword}%");
                })->orWhereHas('store', function ($q2) use ($keyword) {
                    $q2->where('name', 'LIKE', "%{$keyword}%");
                });
            });
        }

        $inventories = $query->orderBy('id', 'desc')->get();

        return view('inventories.index', compact('inventories', 'keyword'));
    }

    // 在庫の削除
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', '在庫を削除しました');
    }

    // 全店舗の在庫一覧（検索対応版）
    public function all(Request $request)
    {
        $keyword = null;
        $query = Inventory::with(['product', 'store']);

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->whereHas('product', function ($q2) use ($keyword) {
                    $q2->where('product_name', 'LIKE', "%{$keyword}%");
                })->orWhereHas('store', function ($q2) use ($keyword) {
                    $q2->where('name', 'LIKE', "%{$keyword}%");
                });
            });
        }

        $inventories = $query->orderBy('id', 'desc')->get();

        return view('inventories.all', compact('inventories', 'keyword'));
    }
}
