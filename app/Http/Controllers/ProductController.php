<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function produk()
    {
        $user = auth()->user()->store_id;
        $data = Product::where('store_id', $user)->get();

        $product = $data->map(function ($q) {
            $stok = Size::where('id_product', $q->id)->get()->sum('stok');

            return [
                'id' => $q->id,
                'nama_product' => $q->nama_product,
                'gambar' => $q->gambar,
                'harga' => $q->harga,
                'stock' => $stok,
                'size' => $q->size,
          ];

        });
        // dd($product);
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
    public function restock()
    {
        
        $daftar = auth()->user()->id;
        $product = Product::where('store_id', $daftar)->get();
        return view('restock', compact('product'));
    }
    public function restockaction(Request $request)
    {
        // dd($request->all());
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        // dd($store);
        $product = Product::find($request->nama);
        // dd($product);
        $admin = User::where('id', $user)->first();
        $add=Purchase::create([
            'store_id'=>$store,
            'user_id'=>$user,
            'total_harga'=>$product->harga,
            'tanggal_pemesanan'=>$request->tanggal_pemesanan,
        ]);
        if (isset($request->nama)) {
            
                // dd($value);
                PurchaseDetail::create([
                    'id_product'=>$product->id,
                    'store_id'=>$store,
                    'purchase_id'=>$add->id,
                    'size'=>$request->size,
                    'qty'=>$request->qty,
                    'harga'=>$product->harga,
                    'status'=>'dikirim',
                    'nama_product'=>$product->nama_product,
                ]);

        }
        
        return redirect()->back()->with('success', 'Add New Product');

    }

    public function validator()
    {
        return view('validator');
    }
}
