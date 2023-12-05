<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\User;
use App\Models\Lunas;
use App\Models\Order;
use App\Models\Store;
use App\Models\Product;
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
        $products = Order::where('store_id', $daftar)->get();
        // dd($product);
        // $post = OrderDetail::leftJoin('tb_product_utama', 'tb_product_utama.id', 'tb_order_detail.product_id') // leftJoin('nama_tabel_join', 'nama_tabel_join.store_id', 'nama_tabel_utama.foreign_key')
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
        return view('belumlunas', compact('products'));
    }
    public function bayar()
    {
        return view('bayar');
    }
    public function getstruk($id)
    {
        $admin = auth()->user()->id;
        $daftar = auth()->user()->store_id;
        $nameadmin = User::where('id', $admin)->first();
        $store = Store::where('id', $daftar)->first();
        $bayar = Order::find($id);
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
        ->where('order_id', $id)->get();
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
        return view('bayar', compact('bayar', 'store', 'nameadmin', 'detail'));

    }
    public function pesananlunas($id)
    {
        // dd($id);
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $product = Order::where('id', $id)->get();
        $product_detail = OrderDetail::where('store_id', $store)->where('order_id', $id)->get();
        // dd($product_detail);
            foreach ($product_detail as $key => $value) {
                // dd($value);
                $stock_tersedia = Size::where('id_product', $value->product_id)->where('size', $value->size)->where('store_id', $store)->first();
                if (isset($value->product_id)) { 
                    // foreach ($value->product_id as $key => $value){
                        $newStok = intval($stock_tersedia->stok) - intval($value->qty);
        
                        $data_product = Size::where('id_product', $value->product_id)->where('size', $value->size)->where('store_id', $store)->update(['stok'=>$newStok,]);
                // }
                }
    
            }
        
        foreach ($product as $key => $value) {
            // dd($value);
            $lunas = Lunas::create([
                'user_id'=>$user,
                'order_id'=>$id,
                'store_id'=>$store,
                'harga'=>$value->total,
                'status'=>'lunas',
                'tanggal_pemesanan'=>$value->created_at,
                'qty'=>$value->qty,
                'name_customer'=>$value->name_customer,
            ]);
            $order = UangMasuk::create([
                'nominal'=>$value->total,
                'tanggal_pemasukan'=>$value->created_at,
                'store_id'=>$store,
                'qty'=>$value->qty,
                'note'=>'penjualan',
                'name_customer'=>$value->name_customer,
                'time'=>Carbon::now()->format('H:i'),
    
            ]);
        }
        // $stock_keluar = $value->qty;
        // dd($stock_keluar);
        


        Order::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
    public function produklunas()
    {
        $daftar = auth()->user()->store_id;
        $products = lunas::where('store_id', $daftar)->get();
        return view('produklunas', compact('products'));
    }
    public function getdetail($order_id)
    {
        $admin = auth()->user()->id;
        $daftar = auth()->user()->store_id;
        $details = OrderDetail::
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
        return view('preview', compact('details'));
    }
}
