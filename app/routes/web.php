<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ホーム画面
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// 🔐 管理者のみ（ユーザー管理・商品管理・全店舗在庫）
Route::middleware(['auth', 'admin'])->group(function () {
    // 一般社員の登録・削除
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/register', [App\Http\Controllers\UserController::class, 'create'])->name('users.register.form');
    Route::post('/users/register', [App\Http\Controllers\UserController::class, 'register'])->name('users.register');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    // 商品管理（登録・編集・削除）
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
    Route::post('/products/register', [App\Http\Controllers\ProductController::class, 'register'])->name('products.register');
    Route::get('/products/register', [App\Http\Controllers\ProductController::class, 'registerForm'])->name('products.registerForm');
    Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');

    // 全店舗の在庫閲覧（/inventories/all）
    Route::get('/inventories/all', [App\Http\Controllers\InventoryController::class, 'all'])->name('inventories.all');
});


// 🧑‍🤝‍🧑 全ユーザー共通（admin / staff 両方が使う機能）
Route::middleware(['auth'])->group(function () {
    // 在庫一覧（自店舗のみ）、削除も自店舗に限り可能
    Route::get('/inventories', [App\Http\Controllers\InventoryController::class, 'index'])->name('inventories.index');
    Route::get('/inventories/{id}', [App\Http\Controllers\InventoryController::class, 'show'])->name('inventories.show');
    Route::delete('/inventories/{id}', [App\Http\Controllers\InventoryController::class, 'destroy'])->name('inventories.destroy');

    // 入荷予定 一覧・登録・編集・削除・入荷確定（すべて自店舗対象）
    Route::get('/incoming-plans', [App\Http\Controllers\IncomingPlanController::class, 'index'])->name('incoming-plans.index');
    Route::get('/incoming-plans/register', [App\Http\Controllers\IncomingPlanController::class, 'registerForm'])->name('incoming-plans.register.form');
    Route::post('/incoming-plans/register', [App\Http\Controllers\IncomingPlanController::class, 'register'])->name('incoming-plans.register');
    Route::get('/incoming-plans/{id}/edit', [App\Http\Controllers\IncomingPlanController::class, 'edit'])->name('incoming-plans.edit');
    Route::put('/incoming-plans/{id}', [App\Http\Controllers\IncomingPlanController::class, 'update'])->name('incoming-plans.update');
    Route::delete('/incoming-plans/{id}', [App\Http\Controllers\IncomingPlanController::class, 'destroy'])->name('incoming-plans.destroy');

    // 入荷確定（在庫に反映）
    Route::post('/incoming-plans/{id}/confirm', [App\Http\Controllers\IncomingPlanController::class, 'confirm'])->name('incoming-plans.confirm');

    // 入荷予定の詳細（入荷予定日＋店舗名）
    Route::get('/incoming-plans/{date}/{store}', [App\Http\Controllers\IncomingPlanController::class, 'show'])->name('incoming-plans.show');
});
