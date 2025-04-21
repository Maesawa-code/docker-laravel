<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 一般社員一覧（検索対応）
    public function index(Request $request)
    {
        $query = User::with('store')
            ->where('role', 'staff')
            ->whereNull('deleted_at');

        // 検索条件
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhereHas('store', function ($q2) use ($keyword) {
                      $q2->where('name', 'LIKE', "%{$keyword}%");
                  });
            });
        }

        $users = $query->orderBy('id', 'desc')->get();

        return view('users.index', compact('users'));
    }

    // 一般社員登録画面
    public function create()
    {
        return view('users.register');
    }

    // 一般社員登録処理
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'store_id' => 'required|exists:stores,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'store_id' => $request->store_id,
            'role' => 'staff',
        ]);

        return redirect()->route('users.index')->with('success', '社員を登録しました');
    }

    // 一般社員削除（ソフトデリート）
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', '社員を削除しました');
    }
}
