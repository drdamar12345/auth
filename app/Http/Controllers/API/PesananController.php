<?php

namespace App\Http\Controllers\API;

use App\Models\Size;
use App\Models\User;
use App\Models\Lunas;
use App\Models\Order;
use App\Models\Product;
use App\Models\UangMasuk;
use App\Models\UangKeluar;
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
            'tb_product_utama.merk',// 'nama_tabel.nama_kolom'
            // lanjutkan kebawah untuk ambil data yang dibutuhkan
        )->where('tb_lunas.store_id', $daftar)->where('status', 'lunas')->get();
        // dd($post);
        return $this->sendResponse($post, 'Products retrieved successfully.');
    }

    public function getstruk()
    {
        $daftar = auth()->user()->store_id;
        $detail = OrderDetail::
        leftJoin('tb_product_utama', 'tb_product_utama.id', 'tb_order_detail.product_id')
        ->leftJoin('users', 'users.id', 'tb_order_detail.store_id')
        ->leftJoin('tb_store', 'tb_store.id', 'tb_order_detail.store_id')
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

    public function pesananlunas(Request $request)
    {
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $product = OrderDetail::where('order_id', $request -> order_id)->get();
        foreach ($product as $key => $value) {
            $nameproduct = Product::where('id', $value->product_id)->where('store_id', $store)->first();
            $order = UangMasuk::create([
                'nominal'=>$value->harga,
                'tanggal_pemasukan'=>$value->tanggal_pemesanan,
                'store_id'=>$store,
                'qty'=>$value->qty,
                'note'=>'penjualan',
                'name_customer'=>$value->name_customer,
                'name_product'=>$nameproduct->nama_product ?? null,
            ]);
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
            if (isset ($stock_tersedia)) { 
                $newStok = intval($stock_tersedia->stok) - intval($value->qty);
    
                $data_product = Size::where('id_product', $value->product_id)->where('size', $value->size)->where('store_id', $store)->update(['stok'=>$newStok,]);
            }
        }
        // OrderDetail::where('order_id', $request->order_id)->delete();
        return $this->sendResponse([$lunas, $order], 'Products retrieved successfully.');
    }

    public function rekappemasukan()
    {
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $total = UangMasuk::sum('nominal');
        $nameadmin = User::where('id', $user)->first();
        $products = UangMasuk::where('store_id', $store)->get();
        return $this->sendResponse([$nameadmin, $products, $total], 'Products retrieved successfully.');
    }

    public function generateuangmasuk(Request $request)
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $nameadmin = User::where('id', $admin)->first();
        $total = UangMasuk::sum('nominal');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $products = UangMasuk::whereBetween('tanggal_pemasukan', [$startDate, $endDate])->where('store_id', $store)->get();

        return $this->sendResponse([$nameadmin, $products, $total], 'Products retrieved successfully.');
  
    }

    public function rekappengeluaran()
    {
        $admin = auth()->user()->id;
        $total = UangKeluar::sum('total');
        $store = auth()->user()->store_id;
        $nameadmin = User::where('id', $admin)->first();
        $products = UangKeluar::where('store_id', $store)->get();
        return $this->sendResponse([$nameadmin, $products, $total], 'Products retrieved successfully.');
    }

    public function generateuangkeluar(Request $request)
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $total = UangKeluar::sum('total');
        $nameadmin = User::where('id', $admin)->first();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $products = UangKeluar::whereBetween('tanggal_pengeluaran', [$startDate, $endDate])->where('store_id', $store)->get();
        // $total = UangKeluar::whereBetween('tanggal_pengeluaran', [$startDate, $endDate])->get()->sum('total');
        return $this->sendResponse([$nameadmin, $products, $total], 'Products retrieved successfully.');
    }
}
