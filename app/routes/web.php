<?php
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/inventories', [App\Http\Controllers\InventoryController::class, 'index'])->name('inventories.index');
Route::post('/products/register', [App\Http\Controllers\ProductController::class, 'register'])->name('products.register');
Route::get('/products/register', [App\Http\Controllers\ProductController::class, 'registerForm'])->name('products.registerForm');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('/users/register', [App\Http\Controllers\UserController::class, 'create'])->name('users.register.form');
Route::post('/users/register', [App\Http\Controllers\UserController::class, 'register'])->name('users.register');
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
Route::get('/incoming-plans', [App\Http\Controllers\IncomingPlanController::class, 'index'])->name('incoming-plans.index');
Route::get('/incoming-plans/register', [App\Http\Controllers\IncomingPlanController::class, 'registerForm'])->name('incoming-plans.register.form');
Route::post('/incoming-plans/register', [App\Http\Controllers\IncomingPlanController::class, 'register'])->name('incoming-plans.register');
Route::get('/incoming-plans/{id}/edit', [App\Http\Controllers\IncomingPlanController::class, 'edit'])->name('incoming-plans.edit');
Route::put('/incoming-plans/{id}', [App\Http\Controllers\IncomingPlanController::class, 'update'])->name('incoming-plans.update');
Route::get('/incoming-plans/{date}/{store}', [App\Http\Controllers\IncomingPlanController::class, 'show'])->name('incoming-plans.show');
Route::delete('/incoming-plans/{id}', [App\Http\Controllers\IncomingPlanController::class, 'destroy'])->name('incoming-plans.destroy');
Route::post('/incoming-plans/{id}/confirm', [App\Http\Controllers\IncomingPlanController::class, 'confirm'])->name('incoming-plans.confirm');