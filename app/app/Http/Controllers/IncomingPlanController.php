<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomingPlan;

class IncomingPlanController extends Controller
{
    public function index()
    {
        $incomingPlans = IncomingPlan::with('store', 'product')->get();
        return view('incoming_plans.index', compact('incomingPlans'));
    }
}
