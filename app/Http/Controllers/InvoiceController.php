<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UangMasuk;
use App\Models\UangKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function rekappemasukan()
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $total = UangMasuk::sum('nominal');
        $nameadmin = User::where('id', $admin)->first();
        $products = UangMasuk::where('store_id', $store)->get();
        return view('rekappemasukan', compact('products', 'nameadmin', 'total'));
    }
    public function generateuangmasuk(Request $request)
    {
        $admin = auth()->user()->id;
        $nameadmin = User::where('id', $admin)->first();
        $total = UangMasuk::sum('nominal');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $products = UangMasuk::whereBetween('tanggal_pemasukan', [$startDate, $endDate])->get();
        return view('rekappemasukan', compact('products','nameadmin', 'total'));
    }
    public function rekappengeluaran()
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $nameadmin = User::where('id', $admin)->first();
        $products = UangKeluar::where('store_id', $store)->get();
        return view('rekappengeluaran', compact('products', 'nameadmin'));
    }
    public function generateuangkeluar(Request $request)
    {
        $admin = auth()->user()->id;
        $nameadmin = User::where('id', $admin)->first();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $products = UangKeluar::whereBetween('tanggal_pengeluaran', [$startDate, $endDate])->get();
        return view('rekappengeluaran', compact('products','nameadmin'));
    }
}
