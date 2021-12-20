<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\ProductController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/produk/{produk}', [ProductController::class, 'show'])->name('product.detail');
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang', [CartController::class, 'store'])->name('cart.store');
Route::delete('/keranjang/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order/cekongkir', [OrderController::class, 'cekOngkir'])->name('order.ongkir');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/pembayaran', [OrderController::class, 'show'])->name('order.payment');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
