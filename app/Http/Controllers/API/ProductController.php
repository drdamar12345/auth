<?php

namespace App\Http\Controllers\API;

use App\Models\Size;
use App\Models\UangKeluar;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
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
        $size = Size::where('id_product', $q->id)->get();

            return [
                'id' => $q->id,
                'nama_product' => $q->nama_product,
                'gambar' => $q->gambar,
                'harga' => $q->harga,
                'stock' => $stok,
                'size' => $size,
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

    public function hapus_action(Request $request){
        Keranjang::where('id', $request->id)->delete();
        return $this->sendResponse('succes', 'Products retrieved successfully.');
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

    public function restock()
    {
        
        $daftar = auth()->user()->store_id;
        $product = Product::where('store_id', $daftar)->get();
        return $this->sendResponse($product, 'Products retrieved successfully.');
    }

    public function restockaction(Request $request)
    {
        // dd($request->all());
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $product = Product::find($request->id);
        $admin = User::where('id', $user)->first();
        $add = Purchase::create([
            'store_id'=>$store,
            'user_id'=>$user,
            'total_harga'=>$product->harga,
            'tanggal_pemesanan'=>$request->tanggal_pemesanan,
        ]);
        if (isset($request->id)) {
                // dd($value);
        $Purchase = PurchaseDetail::create([
                    'id_product'=>$product->id,
                    'store_id'=>$store,
                    'purchase_id'=>$add->id,
                    'size'=>$request->size,
                    'qty'=>$request->qty,
                    'harga'=>$product->harga,
                    'status'=>'dikirim',
                    'nama_product'=>$product->nama_product,
                    'tanggal_pemesanan'=>$add->tanggal_pemesanan,
                ]);
        }
        return $this->sendResponse([$add,$Purchase], 'Products retrieved successfully.');
    }

    public function validator()
    {
        $daftar = auth()->user()->id;
        $pesanan = PurchaseDetail::where('store_id', $daftar)->get();
        return view('validator', compact('pesanan'));
    }

    public function validatoraccept(Request $request)
    {
        $daftar = auth()->user()->store_id;
        $pesanan = PurchaseDetail::where('id', $request -> id)->first();
        // dd($id);
        // $stokbarang = Size::where('id_product', $pesanan)->get();
        $stock_masuk = $pesanan->qty;
        $product_id = $pesanan->id_product;
        
        $data_product = Size::where('id_product', $product_id)
        ->where('size', $pesanan->size)->where('store_id', $daftar)->first();
        // dd($data_product);
        if ($data_product) {
            $newStok = intval($data_product->stok) + intval($stock_masuk);
            // dd($data_product);

            $data_product = Size::where('id_product', $product_id)
        ->where('size', $pesanan->size)->where('store_id', $daftar)->update([
            'stok'=>$newStok,
        ]);
    
            // $data_product->stok = $newStok;
            // $data_product->save();
        }


        
        UangKeluar::create([
            'nominal'=>$pesanan->harga,
            'tanggal_pengeluaran'=>$pesanan->tanggal_pemesanan,
            'note'=>'restock',
            'store_id'=>$daftar,
            'qty'=>$pesanan->qty,

        ]);


        // PurchaseDetail::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product added to favourite successfully!');
    }
}
