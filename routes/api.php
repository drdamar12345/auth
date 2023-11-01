<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PasswordController;
use App\Http\Controllers\API\SuperAdminController;

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
});
