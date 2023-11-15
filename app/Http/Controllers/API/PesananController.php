<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UangMasuk;
use App\Models\Size;
use App\Models\Product;
use App\Models\Lunas;
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
//belum
    public function getstruk()
    {
        $daftar = auth()->user()->store_id;
        // $total = auth()->user()->total;
        // $satu = Order::where('total', $total)->get();
        //buat satu satu
        $detail = OrderDetail::
        leftJoin('tb_product_utama', 'tb_product_utama.id', 'tb_order_detail.product_id')
        ->leftJoin('users', 'users.id', 'tb_order_detail.store_id')
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
            'users.name',
            'tb_store.name_store',
            'tb_order.total'
        ) 
        ->where('tb_order_detail.store_id', $daftar)->get();
        return $this->sendResponse($detail, 'Products retrieved successfully.');
    }
//belum
    public function pesananlunas(Request $request)
    {
        // dd($order_id);
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $product = OrderDetail::where('order_id', $request -> order_id)->get();
        // return $this->sendResponse($product, 'Products retrieved successfully.');
        // dd($product);
        foreach ($product as $key => $value) {
            // return $this->sendResponse($value, 'Products retrieved successfully.');
            $nameproduct = Product::where('id', $value->product_id)->where('store_id', $store)->first();
            // dd($nameproduct);
            $order = UangMasuk::create([
                'nominal'=>$value->harga,
                'tanggal_pemasukan'=>$value->tanggal_pemesanan,
                'store_id'=>$store,
                'qty'=>$value->qty,
                'note'=>'penjualan',
                'name_customer'=>$value->name_customer,
                'name_product'=>$nameproduct->nama_product,
            ]);
            // return $this->sendResponse( $order, 'Products retrieved successfully.');
            $lunas = Lunas::create([
                'user_id'=>$user,
                'order_id'=>$value->order_id,
                'product_id'=>$value->product_id,
                'store_id'=>$store,
                'size'=>$value->size,
                'harga'=>$value->harga,
                'status'=>'lunas',
                'name_customer'=>$value->name_customer,
                'tanggal_pemesanan'=>$value->tanggal_pemesanan,
                'qty'=>$value->qty,
            ]);
            $stock_tersedia = Size::where('id_product', $value->product_id)->where('size', $value->size)->where('store_id', $store)->first();
            // return $this->sendResponse( $stock_tersedia, 'Products retrieved successfully.');
            if (isset ($stock_tersedia)) { 
                $newStok = intval($stock_tersedia->stok) - intval($value->qty);
    
                $data_product = Size::where('id_product', $value->product_id)->where('size', $value->size)->where('store_id', $store)->update(['stok'=>$newStok,]);
            }

        }

        OrderDetail::where('order_id', $request->order_id)->delete();
     
        return $this->sendResponse([$lunas, $order], 'Products retrieved successfully.');
    }
}
