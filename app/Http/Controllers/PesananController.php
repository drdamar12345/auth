<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Lunas;
use App\Models\Order;
use App\Models\UangMasuk;
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
    public function pesananlunas($order_id)
    {
        // dd($order_id);
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $product = OrderDetail::where('order_id', $order_id)->get();
        dd($product);
        $stock_keluar = $product->qty;
        // dd($stock_keluar);
        $order = UangMasuk::create([
            'nominal'=>$product->harga,
            'tanggal_pemasukan'=>$product->tanggal_pemesanan,
            'store_id'=>$store,
            'qty'=>1,

        ]);
        dd($order);
        $lunas = Lunas::create([
            'user_id'=>$user,
            'order_id'=>$product->order_id,
            'product_id'=>$product->product_id,
            'store_id'=>$store,
            'size'=>$product->size,
            'harga'=>$product->harga,
            'status'=>'lunas',
            'name_customer'=>$product->name_customer,
            'tanggal_pemesanan'=>$product->tanggal_pemesanan,
            'qty'=>1,
        ]);
        $stock_tersedia = Size::where('product_id', $product)->where('size', $product->size)->where('store_id', $store)->first();

        if (isset($product->product_id)) {
            foreach ($product->product_id as $key => $value) {
                $newStok = intval($stock_tersedia->stok) - intval($stock_keluar);

                $data_product = Size::where('id_product', $product_id)->where('size', $pesanan->size)->where('store_id', $daftar)->update(['stok'=>$newStok,]);
        }
        }
        OrderDetail::whereIn('order_id', $product->order_id)->delete();
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
}
