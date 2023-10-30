<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperController;
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
    return view('login1');
});
//register 
Route::post('register1', [UserController::class, 'actionregister'])->name('actionregister');
Route::get('register1', [UserController::class, 'register1'])->name('register1');
// login
Route::get('login1', [UserController::class, 'login1'])->name('login1');
Route::post('login1', [UserController::class, 'login_action'])->name('login_action');
// change password 
Route::get('ubahpassword', [UserController::class, 'ubahpassword'])->name('ubahpassword');
Route::post('ubahpassword', [UserController::class, 'password_action'])->name('password_action');

Auth::routes();


Route::middleware('auth')->group( function () {
    // Super Admin
    Route::get('superadmin', [SuperController::class, 'superadmin'])->name('superadmin');
    // Home
    Route::get('home', [UserController::class, 'home'])->name('home');
    // daftar produk
    Route::get('produk', [ProductController::class, 'produk'])->name('produk');
    // keranjang
    Route::get('keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang');
    Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');

});