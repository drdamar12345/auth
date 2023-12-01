<?php

namespace App\Http\Controllers;

use App\Models\UangMasuk;
use App\Models\UangKeluar;
use Illuminate\Http\Request;
use App\Models\LogProductDetail;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function logproduct()
    {
        $daftar = auth()->user()->id;
        $store = auth()->user()->store_id;
        $products = LogProductDetail::where('store_id', $store)->get();
        return view('logproduct', compact('products'));
    }
    public function generatelogproduct(Request $request)
    {
        $daftar = auth()->user()->id;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $products = LogProductDetail::whereBetween('date', [$startDate, $endDate])->get();

        return view('logproduct', compact('products'));
    }
    public function logkasmasuk()
    {
        $store = auth()->user()->store_id;
        $products = UangMasuk::where('store_id', $store)->get();
        $total = UangMasuk::where('store_id', $store)->get()->sum('nominal');
        return view('logkasmasuk', compact('products', 'total'));
    }
    public function generatelogkasmasuk(Request $request)
    {
        $store = auth()->user()->store_id;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $products = UangMasuk::whereBetween('tanggal_pemasukan', [$startDate, $endDate])->get();
        $total = UangMasuk::whereBetween('tanggal_pemasukan', [$startDate, $endDate])->get()->sum('nominal');

        return view('logkasmasuk', compact('products', 'total'));
    }
    public function logkaskeluar()
    {
        $store = auth()->user()->store_id;
        $products = UangKeluar::where('store_id', $store)->get();
        $total = UangKeluar::where('store_id', $store)->get()->sum('total');
        return view('logkaskeluar', compact('products', 'total'));
    }
    public function generatelogkaskeluar(Request $request)
    {
        $store = auth()->user()->store_id;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $products = UangKeluar::whereBetween('tanggal_pengeluaran', [$startDate, $endDate])->get();
        $total = UangKeluar::whereBetween('tanggal_pengeluaran', [$startDate, $endDate])->get()->sum('total');

        return view('logkaskeluar', compact('products', 'total'));
    }
}
