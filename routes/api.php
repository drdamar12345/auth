<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\PesananController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\PasswordController;
use App\Http\Controllers\API\SuperAdminController;
use App\Http\Controllers\API\LogAktivityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//login register
Route::post('login', [LoginController::class, 'login_action']);
Route::post('register', [LoginController::class, 'register_action']);

//ubah password
Route::post('ubah_pw', [PasswordController::class, 'password_action']);

//



Route::middleware('auth:api')->group( function () {

// data yang login
Route::get('data', [UserController::class, 'profil']);

// data produk
Route::get('data_produk', [ProductController::class, 'produk']);

//log out
Route::post('keluar', [UserController::class, 'logout_action']);

//actionformstore
Route::post('nama_store', [SuperAdminController::class, 'actionformstore']);

//daftar store
Route::get('data_store', [SuperAdminController::class, 'daftarstore']);

//daftar admin
Route::get('data_admin', [SuperAdminController::class, 'daftaradmin']);

//mengubah id
Route::post('ubah_id', [SuperAdminController::class, 'actionid']);

//menambahkan produk baru
Route::post('new_product', [ProductController::class, 'addnewproduct']);

//menambahkan produk ke keranjang
Route::post('produk_keranjang', [ProductController::class, 'addToCart']);

//data keranjang
Route::get('data_keranjang', [ProductController::class, 'keranjang']);

//hapus data keranjang
Route::post('hapus', [ProductController::class, 'hapus_action']);

//menambahkan pelanngan
Route::post('pelanggan', [CustomerController::class, 'addnewcustomer']);

//data pelanggan
Route::get('data_pelanggan', [CustomerController::class, 'daftarpelanggan']);

//edit status pelanggan
Route::post('edit_status_pelanggan', [CustomerController::class, 'actionstatuspelanggan']);

//daftar pembeli berdasarkan id
Route::post('pembeli', [CustomerController::class, 'data_pembeli']);

//menambahkan restok
Route::post('restock', [ProductController::class, 'restockaction']);

//data restok 
Route::get('data_restock', [ProductController::class, 'restock']);

//setuju atau tidakk
Route::post('validator', [ProductController::class, 'validatoraccept']);

//hapus validator
Route::post('hapus_validator', [ProductController::class, 'removevalidator']);

//data validator lur
Route::get('dav', [ProductController::class, 'data_validator']);

// chekout barang
Route::post('cek', [ProductController::class, 'pesananction']);

// datanya ga lunas
Route::get('data_belum_lunas', [PesananController::class, 'belumlunas']);

//data lunas
Route::get('data_lunas', [PesananController::class, 'produklunas']);

// struk
Route::get('struk', [PesananController::class, 'getstruk']);

//pesnan lunas
Route::post('pesan_lunas', [PesananController::class, 'pesananlunas']);

//rekappemasukan
Route::get('data_uang_masuk', [PesananController::class, 'rekappemasukan']);

//rekapp masuk
Route::post('rekapp_masuk', [PesananController::class, 'generateuangmasuk']);

//rekappengeluaran
Route::get('data_uang_keluar', [PesananController::class, 'rekappengeluaran']);

//data
Route::post('rekapp_keluar', [PesananController::class, 'generateuangkeluar']);

//logAktivity
Route::get('aktivity_uang_masuk', [LogAktivityController::class, 'aktivitymasuk']);
});
