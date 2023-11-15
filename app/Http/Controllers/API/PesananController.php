<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesananController extends BaseController
{
    public function belumlunas()
    {
        $daftar = auth()->user()->store_id;
        // dd($daftar);
        $product = OrderDetail::where('store_id', $daftar)->get();
        $post = OrderDetail::leftJoin('tb_product_utama', 'tb_product_utama.id', 'tb_order_detail.product_id') // leftJoin('nama_tabel_join', 'nama_tabel_join.store_id', 'nama_tabel_utama.foreign_key')
        ->select(
            'tb_order_detail.user_id',
            'tb_order_detail.order_id',
            'tb_order_detail.product_id',
            'tb_order_detail.store_id',
            'tb_order_detail.size',
            'tb_order_detail.harga',
            'tb_order_detail.status',
            'tb_order_detail.name_customer',
            'tb_order_detail.tanggal_pemesanan',
            'tb_order_detail.qty', // 'nama_tabel.nama_kolom'
            'tb_product_utama.nama_product',
            'tb_product_utama.gambar',
            'tb_product_utama.merk', // 'nama_tabel.nama_kolom'
            // lanjutkan kebawah untuk ambil data yang dibutuhkan
        )->where('tb_order_detail.store_id', $daftar)->where('status', 'belum lunas')->get();
        // dd($post);
        return $this->sendResponse($post, 'Products retrieved successfully.');
    }

    public function getstruk()
    {
        $daftar = auth()->user()->store_id;
        // $total = auth()->user()->total;
        // $satu = Order::where('total', $total)->get();
        //buat satu satu
        $detail = OrderDetail::
        leftJoin('tb_product_utama', 'tb_product_utama.id', 'tb_order_detail.product_id')
        ->leftJoin('Users', 'Users.id', 'tb_order_detail.product_id')
        ->leftJoin('tb_store', 'tb_store.id', 'tb_order_detail.product_id')
        ->leftJoin('tb_order', 'tb_order.id', 'tb_order_detail.product_id')
        ->select(
            'tb_order_detail.user_id',
            'tb_order_detail.order_id',
            'tb_order_detail.product_id',
            'tb_order_detail.store_id',
            'tb_order_detail.harga',
            'tb_order_detail.name_customer',
            'tb_order_detail.tanggal_pemesanan',
            'tb_order_detail.qty', 
            'tb_product_utama.nama_product',
            'Users.name',
            'tb_store.name_store',
            'tb_order.total'
        ) 
        ->where('tb_order_detail.store_id', $daftar)->get();
        return $this->sendResponse($detail, 'Products retrieved successfully.');
    }
}
