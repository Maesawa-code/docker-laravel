<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('store')->where('role', 'staff')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'store_id' => 'required|exists:stores,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'store_id' => $request->store_id,
            'role' => 'staff',
        ]);

        return redirect()->route('users.index')->with('success', '社員を登録しました');
    }
}
