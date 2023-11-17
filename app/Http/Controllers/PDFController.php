<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\UangMasuk;
use App\Models\UangKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{
    public function uangmasuk()
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $total = UangMasuk::where('store_id', $store)->get()->sum('nominal');
        $nameadmin = User::where('id', $admin)->first();
        $products = UangMasuk::where('store_id', $store)->get();
        return view('uangmasuk', compact('products', 'nameadmin', 'total'));
    }
    public function cetakPDF()
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $nameadmin = User::where('id', $admin)->first();
        $data = UangMasuk::where('store_id', $store)->get();
        $products = UangMasuk::where('store_id', $store)->get();
        $total = UangMasuk::where('store_id', $store)->get()->sum('nominal');


        $pdf = PDF::loadView('uangmasuk', [$data, 'nameadmin'=>$nameadmin, 'products'=>$products, 'total'=>$total])->setOptions(['defaultFont' => 'sans-serif']);
        $output = $pdf->output();


        return $pdf->download('uangmasuk.pdf', compact('nameadmin', 'products', 'total'));
    }
    public function uangkeluar()
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $total = UangKeluar::where('store_id', $store)->get()->sum('total');
        $nameadmin = User::where('id', $admin)->first();
        $products = UangKeluar::where('store_id', $store)->get();
        return view('uangkeluar', compact('products', 'nameadmin', 'total'));
    }
    public function cetakPDFkeluar()
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $nameadmin = User::where('id', $admin)->first();
        $data = UangKeluar::where('store_id', $store)->get();
        $products = UangKeluar::where('store_id', $store)->get();
        $total = UangKeluar::where('store_id', $store)->get()->sum('total');
        // dd("aaa");


        $pdf = PDF::loadView('uangkeluar', [$data, 'nameadmin'=>$nameadmin, 'products'=>$products, 'total'=>$total])->setOptions(['defaultFont' => 'sans-serif']);
        $output = $pdf->output();


        return $pdf->download('uangkeluar.pdf', compact('nameadmin', 'products', 'total'));
    }
}
