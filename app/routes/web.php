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