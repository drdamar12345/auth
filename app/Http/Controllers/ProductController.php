<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\User;
use App\Models\Product;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function produk()
    {
        $user = auth()->user()->store_id;
        $product = Product::where('store_id', $user)->get();
        return view('produk', compact('product'));
    }
    public function addToCart(Request $request)

    {
        // dd($request->all()); 
        $user = auth()->user()->id;
        $product = Product::findOrFail($request->id);
        $id = User::where('id', $user)->first();
        $admin = Keranjang::create([
            'id_product'=>$product->id,
            'nama_product'=>$product->nama_product,
            'gambar'=>$product->gambar,
            'harga'=>$product->harga,
            'user_id'=>$user,
            'qty'=>1,
            'ukuransepatu'=>$request->ukuransepatu,
            'store_id'=>$id->store_id,
        ]);
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
    public function removekeranjang($id, Request $request)

    {
        $productId = $request->input('id');
    
    // Logic to remove the product from the cart
    Keranjang::where('id', $id)->delete();
    
    // Redirect back to the cart page or any other appropriate page
    return redirect()->route('keranjang');

    }
    public function addproduct()
    {
        return view('addproduct');
    }
    public function addnewproduct(Request $request)
    {
        // dd($request->all());
        $user = auth()->user()->id;
        $admin = User::where('id', $user)->first();
        // dd($admin);
        $add=Product::create([
            'nama_product'=>$request->nama_product,
            'merk'=>$request->merk,
            'warna'=>$request->warna,
            'harga'=>$request->harga,
            'gambar'=>$request->gambar,
            'store_id'=>$admin->store_id,

        ]);
        if (isset($request->size)) {
            foreach ($request->size as $key => $value) {
                // dd($value);
                Size::create([
                    'id_product'=>$add->id,
                    'size'=>$value,
                    'stok'=>$request->stok,
                    'status'=>'tersedia',
                    'store_id'=>$admin->store_id,
                ]);
            }
        }
        
        return redirect()->back()->with('success', 'Add New Product');

    }
    public function bayar()
    {
        return view('bayar');
    }

}
