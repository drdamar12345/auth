<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeranjangController extends Controller
{
    public function keranjang()
    {
        $daftar = auth()->user()->id;
        $user = auth()->user()->store_id;
        $customer = Customer::where('store_id', $daftar)->get();
        $cart = Keranjang::where('store_id', $user)->get();
        // dd($cart);
        return view('keranjang', compact('cart', 'customer'));
    }
    
}

