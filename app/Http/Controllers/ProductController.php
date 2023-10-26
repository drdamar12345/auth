<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function produk()
    {
        $product = Product::all();
        return view('produk', compact('product'));
    }
    public function addToCart(Request $request)

    {
        // dd($request->all()); 
        $user = auth()->user()->id;
        $product = Product::findOrFail($request->id);
        $admin = Keranjang::create([
            'id_product'=>$product->id,
            'nama_product'=>$product->nama_product,
            'gambar'=>$product->gambar,
            'harga'=>$product->harga,
            'user_id'=>$user,
            'qty'=>1,
            'ukuransepatu'=>$request->ukuran,
        ]);

          

        $keranjang = session()->get('keranjang', []);

  

        if(isset($keranjang[$product->id])) {

            $keranjang[$product->id]['quantity']++;

        } else {

            $keranjang[$product->id] = [

                "nama_product" => $product->nama_product,

                "quantity" => 1,

                "price" => $product->harga,

                "image" => $product->gambar,

            ];
           

        }

          

        session()->put('keranjang', $keranjang);
        

        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
}
