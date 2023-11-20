<?php

namespace App\Http\Controllers;

use App\Models\User;
use PDF;
use App\Models\UangMasuk;
use App\Models\UangKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function rekappemasukan_pdf()
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $total = UangMasuk::where('store_id', $store)->get()->sum('nominal');
        $nameadmin = User::where('id', $admin)->first();
        $products = UangMasuk::where('store_id', $store)->get();
        return view('rekappemasukan_pdf', compact('products', 'nameadmin', 'total'));
    }
    public function generateuangmasuk(Request $request)
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $data = UangMasuk::where('store_id', $store)->get();
        $nameadmin = User::where('id', $admin)->first();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $products = UangMasuk::whereBetween('tanggal_pemasukan', [$startDate, $endDate])->get();
        $total = UangMasuk::whereBetween('tanggal_pemasukan', [$startDate, $endDate])->get()->sum('nominal');
        $pdf = PDF::loadView('uangmasuk', [$data, 'nameadmin'=>$nameadmin, 'products'=>$products, 'total'=>$total])->setOptions(['defaultFont' => 'sans-serif']);
        $output = $pdf->output();


        return $pdf->download('uangmasuk.pdf', compact('nameadmin', 'products', 'total'));
        return view('rekappemasukan_pdf', compact('products','nameadmin', 'total'));
    }
    public function rekappengeluaran_pdf()
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $nameadmin = User::where('id', $admin)->first();
        $products = UangKeluar::where('store_id', $store)->get();
        $total = UangKeluar::where('store_id', $store)->get()->sum('total');
        return view('rekappengeluaran_pdf', compact('products', 'nameadmin', 'total'));
    }
    public function generateuangkeluar(Request $request)
    {
        $admin = auth()->user()->id;
        $nameadmin = User::where('id', $admin)->first();
        $store = auth()->user()->store_id;
        $data = UangMasuk::where('store_id', $store)->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $products = UangKeluar::whereBetween('tanggal_pengeluaran', [$startDate, $endDate])->get();
        $total = UangKeluar::whereBetween('tanggal_pengeluaran', [$startDate, $endDate])->get()->sum('total');
        $pdf = PDF::loadView('uangkeluar', [$data, 'nameadmin'=>$nameadmin, 'products'=>$products, 'total'=>$total])->setOptions(['defaultFont' => 'sans-serif']);
        $output = $pdf->output();


        return $pdf->download('uangkeluar.pdf', compact('nameadmin', 'products', 'total'));
        return view('rekappengeluaran_pdf', compact('products', 'nameadmin', 'total'));
    }
}
