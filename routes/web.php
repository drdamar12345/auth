<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
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
    // Super Admin Add Store 
    Route::get('formstore', [SuperController::class, 'formstore'])->name('formstore');
    Route::post('formstore', [SuperController::class, 'actionformstore'])->name('actionformstore');
    // Super Admin List Store
    Route::get('daftarstore', [SuperController::class, 'daftarstore'])->name('daftarstore');
    // Super Admin List Admin
    Route::get('daftaradmin', [SuperController::class, 'daftaradmin'])->name('daftaradmin');
    // Super Admin Add ID Admin
    Route::post('daftaradmin/{id}', [SuperController::class, 'idadmin'])->name('idadmin');
    // Show Detail Aadmin
    Route::get('stores/{id}', [SuperController::class, 'show'])->name('show');
    Route::get('actionid', [SuperController::class, 'actionid'])->name('actionid');

    // Home
    Route::get('home', [UserController::class, 'home'])->name('home');
    // daftar produk
    Route::get('produk', [ProductController::class, 'produk'])->name('produk');
    Route::post('proseschart', [ProductController::class, 'addToCart'])->name('proseschart');
    // keranjang
    Route::get('keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang');
    Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
    Route::post('remove-from-keranjang/{id}', [ProductController::class, 'removekeranjang'])->name('remove.from.keranjang');
    // Add Product
    Route::get('addproduct', [ProductController::class, 'addproduct'])->name('addproduct');
    Route::post('addproduct', [ProductController::class, 'addnewproduct'])->name('addnewproduct');
    // Data Customer
    Route::get('addcustomer', [CustomerController::class, 'addcustomer'])->name('addcustomer');
    Route::post('addCustomer', [CustomerController::class, 'addnewcustomer'])->name('addnewcustomer');
    Route::get('daftarcustomer', [CustomerController::class, 'daftarcustomer'])->name('daftarcustomer');
    // Edit Status Customer
    Route::get('details/{id}', [CustomerController::class, 'editstatus'])->name('editstatus');
    Route::get('actionstatus', [CustomerController::class, 'actionstatus'])->name('actionstatus');
    // Restock Product
    Route::get('restock', [ProductController::class, 'restock'])->name('restock');
    Route::post('restock', [ProductController::class, 'restockaction'])->name('restockaction');
    // Validator Restock Product
    Route::get('validator', [ProductController::class, 'validator'])->name('validator');
    Route::get('validatoraccept/{id}', [ProductController::class, 'validatoraccept'])->name('validatoraccept');


    Route::get('bayar', [ProductController::class, 'bayar'])->name('bayar');

    // LogOut
    Route::get('/Logout', [UserController::class, 'Logout'])->name('Logout');
});