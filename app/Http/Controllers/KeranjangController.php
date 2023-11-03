<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeranjangController extends Controller
{
    public function keranjang()
    {
        // return view('keranjang');
        $user = auth()->user()->store_id;
        $cart = Keranjang::where('store_id', $user)->get();
        // dd($cart);
        return view('keranjang', compact('cart'));
    }
    
}

