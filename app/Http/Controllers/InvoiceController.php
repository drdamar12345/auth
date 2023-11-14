<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UangMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function rekappemasukan()
    {
        $admin = auth()->user()->id;
        $store = auth()->user()->store_id;
        $nameadmin = User::where('id', $admin)->first();
        $products = UangMasuk::where('store_id', $store)->get();
        return view('rekappemasukan', compact('products', 'nameadmin'));
    }
}
