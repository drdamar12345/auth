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
        $admin = auth()->user()->id;
        $daftar = auth()->user()->store_id;
        $bayar = Order::find($order_id);
        $nameadmin = User::where('id', $admin)->first();
        $store = Store::where('id', $daftar)->first();
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
        return view('bayar', compact('bayar', 'store', 'nameadmin', 'detail'));

    }
    public function pesananlunas($order_id)
    {
        // dd($order_id);
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $product = OrderDetail::where('order_id', $order_id)->get();
        // dd($product);
        foreach ($product as $key => $value) {
            $nameproduct = Product::where('id', $value->product_id)->where('store_id', $value->store_id)->first();
            // dd($nameproduct);
            $order = UangMasuk::create([
                'nominal'=>$value->harga,
                'tanggal_pemasukan'=>$value->tanggal_pemesanan,
                'store_id'=>$store,
                'qty'=>$value->qty,
                'note'=>'penjualan',
                'name_customer'=>$value->name_customer,
                'name_product'=>$nameproduct->nama_product,
                'time'=>Carbon::now()->format('H:i'),
                'size'=>$value->size,
    
            ]);
            // dd($order);

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
            if (isset($value->product_id)) { 
                // foreach ($value->product_id as $key => $value){
                    $newStok = intval($stock_tersedia->stok) - intval($value->qty);
    
                    $data_product = Size::where('id_product', $value->product_id)->where('size', $value->size)->where('store_id', $store)->update(['stok'=>$newStok,]);
            // }
            }

        }
        // $stock_keluar = $value->qty;
        // dd($stock_keluar);
        


        OrderDetail::where('order_id', $order_id)->delete();
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
    public function produklunas()
    {
        $daftar = auth()->user()->store_id;
        // dd($daftar);
        $product = lunas::where('store_id', $daftar)->get();
        $post = Lunas::leftJoin('tb_product_utama', 'tb_product_utama.id', 'tb_lunas.product_id') // leftJoin('nama_tabel_join', 'nama_tabel_join.store_id', 'nama_tabel_utama.foreign_key')
        ->select(
            'tb_lunas.user_id',
            'tb_lunas.order_id',
            'tb_lunas.product_id',
            'tb_lunas.store_id',
            'tb_lunas.size',
            'tb_lunas.harga',
            'tb_lunas.status',
            'tb_lunas.name_customer',
            'tb_lunas.tanggal_pemesanan',
            'tb_lunas.qty', // 'nama_tabel.nama_kolom'
            'tb_product_utama.nama_product',
            'tb_product_utama.gambar',
            'tb_product_utama.merk', // 'nama_tabel.nama_kolom'
            // lanjutkan kebawah untuk ambil data yang dibutuhkan
        )->where('tb_lunas.store_id', $daftar)->where('status', 'lunas')->get();
        // dd($post);
        return view('produklunas', ['orderList' => $post]);
    }
}
