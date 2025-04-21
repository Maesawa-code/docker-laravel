<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Store;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * 登録後のリダイレクト先
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 登録フォーム表示時にstoresテーブルを渡す
     */
    public function showRegistrationForm()
    {
        $stores = Store::all(); // id, name
        return view('auth.register', compact('stores'));
    }

    /**
     * バリデーションルール
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'store_id' => ['required', 'exists:stores,id'],
        ]);
    }

    /**
     * ユーザー登録処理
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'admin', // 固定でadmin
            'store_id' => $data['store_id'], // プルダウンで選んだ店舗ID
        ]);
    }
}
