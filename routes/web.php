<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KeranjangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware('auth')->group( function () {
    // dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // daftar produk
    Route::get('produk', [ProductController::class, 'produk'])->name('produk');
    // keranjang
    Route::get('keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang');
    Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');

});