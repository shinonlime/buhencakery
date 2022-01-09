<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/keranjang/{produk}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/cekongkir', [OrderController::class, 'cekOngkir'])->name('order.ongkir');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/list/order', App\Http\Livewire\ListOrder::class)->name('order.list');
    // Route::get('/pembayaran/{id}', [OrderController::class, 'show'])->name('order.payment');
    // Route::post('/pembayaran/status', [OrderController::class, 'status'])->name('order.status');
    Route::get('/pembayaran/{id}', App\Http\Livewire\Payment::class)->name('order.payment');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/tambah', [ProductController::class, 'create'])->name('product.create');
    Route::post('/admin/dashboard', [ProductController::class, 'store'])->name('product.store');
    Route::get('/admin/produk', [AdminController::class, 'showProduct'])->name('product.index');
    Route::get('/admin/produk/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/admin/produk/{id}/edit', [ProductController::class, 'update'])->name('product.update');
    Route::get('/admin/produk/hapus/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('/admin/order/detail/{id}', [AdminController::class, 'show'])->name('order.detail');
    Route::get('/admin/order/batal/{id}', [AdminController::class, 'cancel'])->name('order.cancel');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
