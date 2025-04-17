<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function index()
    {
        $users = User::with('store')->where('role', 'staff')->get();
        return view('users.index', compact('users'));
    }
}
