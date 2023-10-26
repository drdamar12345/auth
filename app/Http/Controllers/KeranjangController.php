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
        $cart = Keranjang::all();
        return view('keranjang', compact('cart'));
    }
}
