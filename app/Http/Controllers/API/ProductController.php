<?php

namespace App\Http\Controllers\API;

use App\Models\Size;
use App\Models\User;
use App\Models\Product;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;

class ProductController extends BaseController
{
    public function produk()
    {
        $user = auth()->user()->store_id;
        $data = Product::where('store_id', $user)->get();

        $product = $data->map(function ($q) {
        $stok = Size::where('id_product', $q->id)->get()->sum('stok');
        // $size = Size::where('id_product', $q->id)->get()->sum('size');

            return [
                'id' => $q->id,
                'nama_product' => $q->nama_product,
                'gambar' => $q->gambar,
                'harga' => $q->harga,
                'stock' => $stok,
                // 'size' => $size,
          ];

        });

        return $this->sendResponse($product, 'Products retrieved successfully.');
    }

    public function keranjang()
    {
        // return view('keranjang');
        $user = auth()->user()->store_id;
        $cart = Keranjang::where('store_id', $user)->get();
        // dd($cart);
        return $this->sendResponse($cart, 'Products retrieved successfully.');
    }

    public function addToCart(Request $request)

    {
        // return $this->sendResponse($request->all(), 'Products retrieved successfully.');
        // dd($request->all()); 
        $user = auth()->user()->id;
        $product = Product::findOrFail($request->id_product);
        $id = User::where('id', $user)->first();
        $keranjang = Keranjang::create([
            'id_product'=>$request->id_product,
            'nama'=>$product->nama_product,
            'gambar'=>$product->gambar,
            'harga'=>$product->harga,
            'user_id'=>$user,
            'qty'=>1,
            'ukuransepatu'=>$request->ukuransepatu,
            'store_id'=>$id->store_id,
        ]);
        return $this->sendResponse($keranjang, 'Products retrieved successfully.');

    }

    public function addnewproduct(Request $request)
    {
        // dd($request->all());
        // return $this->sendResponse($request->all(), 'Products retrieved successfully.');
        $user = auth()->user()->id;
        $admin = User::where('id', $user)->first();
        // dd($admin);
        $size = Size::whereIn('id', $request->size)->get();
        // $foto = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('foto')->getClientOriginalName());
        // $request->file('foto')->move(public_path('foto'), $foto);
        if ($request->hasFile('gambar')) {

            // add new image
            $destination_path = public_path('/gambar'); // image public path
            $attachment = $request->file('gambar');
            $attachment_name =  $attachment->getClientOriginalName();
            $attachment->move($destination_path, $attachment_name);
        }

        $add = Product::create([
            'nama_product'=>$request->nama_product,
            'merk'=>$request->merk,
            'warna'=>$request->warna,
            'harga'=>$request->harga,
            'gambar'=>$attachment_name ?? null,
            'store_id'=>$admin->store_id,

        ]);
        if (isset($request->size)) {
            foreach ($request->size as $key => $value) {
                // dd($value);
            $size = Size::create([
                    'id_product'=>$add->id,
                    'size'=>$request->size[$key],
                    'stok'=>$request->stok,
                    'status'=>'tersedia',
                    'store_id'=>$admin->store_id,
                ]);
            }
        }
        
        return $this->sendResponse([$add,$size], 'Products retrieved successfully.');

    }
}
