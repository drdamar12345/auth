<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function produk()
    {
        $product = Product::all();
        return view('produk', compact('product'));
    }
}
