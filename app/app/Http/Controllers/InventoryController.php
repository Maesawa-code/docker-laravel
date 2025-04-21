<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\IncomingPlan;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('product')->whereNull('deleted_at')->get();
        return view('inventories.index', compact('inventories'));
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', '在庫を削除しました');
    }
}
