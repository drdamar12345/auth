<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\StatisticController;

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
    Route::post('home', [ProductController::class, 'addpettycash'])->name('addpettycash');
    Route::get('home', [ProductController::class, 'dashboarditem'])->name('home');
    
    // daftar produk
    Route::get('produk', [ProductController::class, 'produk'])->name('produk');
    Route::post('proseschart', [ProductController::class, 'addToCart'])->name('proseschart');
    Route::get('/product-price/{id}', [ProductController::class, 'getPrice'])->name('product.price');
    // keranjang
    Route::get('keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang');
    Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
    Route::post('remove-from-keranjang/{id}', [ProductController::class, 'removekeranjang'])->name('remove.from.keranjang');
    // Fitur Pesan
    Route::get('prosespesan', [ProductController::class, 'pesananaction'])->name('prosespesan');
    Route::get('pesananaction/{id}', [ProductController::class, 'pesananaction'])->name('pesananaction');
    Route::post('actionpesan', [ProductController::class, 'pesananaction'])->name('actionpesan');
 




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
    Route::post('remove-from-validator/{id}', [ProductController::class, 'removevalidator'])->name('remove.from.validator');
    // Produk Belum Lunas
    Route::get('belumlunas', [PesananController::class, 'belumlunas'])->name('belumlunas');
    // Cetak Struk Pembayaran
    Route::get('bayars/{order_id}', [PesananController::class, 'getstruk'])->name('getstruk');
    // Produk Lunas
    Route::get('pesananlunas/{order_id}', [PesananController::class, 'pesananlunas'])->name('pesananlunas');
    Route::get('produklunas', [PesananController::class, 'produklunas'])->name('produklunas');
    Route::get('previews/{order_id}', [PesananController::class, 'getdetail'])->name('getdetail');
    // Hapus Pesanan
    Route::post('remove-from-pesanan/{id}', [PesananController::class, 'removepesanan'])->name('remove.from.pesanan');
    // Invoice Pemasukkan
    Route::get('rekappemasukan_pdf', [InvoiceController::class, 'rekappemasukan_pdf'])->name('rekappemasukan_pdf');
    Route::post('rekappemasukan_pdf', [InvoiceController::class, 'generateuangmasuk'])->name('generateuangmasuk');

    // Invoice Pengeluaran
    Route::get('rekappengeluaran_pdf', [InvoiceController::class, 'rekappengeluaran_pdf'])->name('rekappengeluaran_pdf');
    Route::post('rekappengeluaran_pdf', [InvoiceController::class, 'generateuangkeluar'])->name('generateuangkeluar');

    // Cetak PDF Uang Masuk
    Route::get('cetakPDF', [PDFController::class, 'cetakPDF'])->name('cetakPDF');
    Route::get('uangmasuk', [PDFController::class, 'uangmasuk'])->name('uangmasuk');
    // Cetak PDF Uang Keluar
    Route::get('cetakPDFkeluar', [PDFController::class, 'cetakPDFkeluar'])->name('cetakPDFkeluar');
    Route::get('uangkeluar', [PDFController::class, 'uangkeluar'])->name('uangkeluar');

    // Log Product
    Route::get('logproduct', [LogController::class, 'logproduct'])->name('logproduct');
    Route::post('logproduct', [LogController::class, 'generatelogproduct'])->name('generatelogproduct');
    // Log Kas Masuk
    Route::get('logkasmasuk', [LogController::class, 'logkasmasuk'])->name('logkasmasuk');
    Route::post('logkasmasuk', [LogController::class, 'generatelogkasmasuk'])->name('generatelogkasmasuk');
    Route::get('incomes/{id}', [LogController::class, 'income'])->name('income');
    Route::get('actionincome', [LogController::class, 'actionincome'])->name('actionincome');
    // Log Kas Keluar
    Route::get('logkaskeluar', [LogController::class, 'logkaskeluar'])->name('logkaskeluar');
    Route::post('logkaskeluar', [LogController::class, 'generatelogkaskeluar'])->name('generatelogkaskeluar');
    // Log Patty Cash
    Route::get('logpattycash', [LogController::class, 'logpattycash'])->name('logpattycash');
    Route::post('logpattycash', [LogController::class, 'generatelogpattycash'])->name('generatelogpattycash');
    // Statistik Penjulan Product
    Route::get('statistics/{id}', [SuperController::class, 'salesStatistics'])->name('salesStatistics');
    Route::get('coba', [StatisticController::class, 'weeklystatistic'])->name('coba');






    








    // LogOut
    Route::get('/Logout', [UserController::class, 'Logout'])->name('Logout');
});