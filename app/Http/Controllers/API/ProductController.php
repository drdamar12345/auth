<?php

namespace App\Http\Controllers\API;

use App\Models\Size;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;

class ProductController extends BaseController
{
    public function produk()
    {
        $product = Product::all();
        return $this->sendResponse($product, 'Products retrieved successfully.');
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
            'gambar'=>$attachment_name,
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
