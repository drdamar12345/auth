<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesananController extends Controller
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
        return view('belumlunas', ['orderList' => $post]);
    }
    public function bayar()
    {
        return view('bayar');
    }
    public function getstruk($order_id)
    {
        $daftar = auth()->user()->store_id;
        $bayar = Order::find($order_id);
        $detail = OrderDetail::
        leftJoin('tb_product_utama', 'tb_product_utama.id', 'tb_order_detail.product_id')
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
            'tb_order_detail.qty', 
            'tb_product_utama.nama_product',
            'tb_product_utama.gambar',
            'tb_product_utama.merk',
        ) 
        ->where('order_id', $order_id)->get();
        // $post = OrderDetail::leftJoin('tb_product_utama', 'tb_product_utama.id', 'tb_order_detail.product_id') 
        // ->select(
        //     'tb_order_detail.user_id',
        //     'tb_order_detail.order_id',
        //     'tb_order_detail.product_id',
        //     'tb_order_detail.store_id',
        //     'tb_order_detail.size',
        //     'tb_order_detail.harga',
        //     'tb_order_detail.status',
        //     'tb_order_detail.name_customer',
        //     'tb_order_detail.tanggal_pemesanan',
        //     'tb_order_detail.qty', 
        //     'tb_product_utama.nama_product',
        //     'tb_product_utama.gambar',
        //     'tb_product_utama.merk',
        // )->where('tb_order_detail.store_id', $daftar)->where('status', 'belum lunas')->get();
        // dd($bayar);
        // return view('bayar', ['bayar' => $post]);
        return view('bayar', compact('bayar', 'detail'));

    }
}
