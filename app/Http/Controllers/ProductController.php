<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Keranjang;
use App\Models\UangKeluar;
use App\Models\OrderDetail;
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
                    'tanggal_pemesanan'=>$request->tanggal_pemesanan,
                ]);

        }
        
        return redirect()->back()->with('success', 'Add New Product');

    }

    public function validator()
    {
        $daftar = auth()->user()->id;
        $pesanan = PurchaseDetail::where('store_id', $daftar)->get();
        return view('validator', compact('pesanan'));
    }
    public function validatoraccept($id)
    {
        $admin = auth()->user()->id;
        $nameadmin = User::where('id', $admin)->first();
        $daftar = auth()->user()->store_id;
        $pesanan = PurchaseDetail::where('id', $id)->first();
        // dd($pesanan);
        // dd($id);
        // $stokbarang = Size::where('id_product', $pesanan)->get();
        $stock_masuk = $pesanan->qty;
        // dd($stock_masuk);
        $product_id = $pesanan->id_product;
        
        $data_product = Size::where('id_product', $product_id)
        ->where('size', $pesanan->size)->where('store_id', $daftar)->first();
        // dd($data_product);
        if ($data_product === null) {
            $admin = Size::create([
                'id_product'=>$pesanan->id_product,
                'size'=>$pesanan->size,
                'stok'=>$pesanan->qty,
                'status'=>'tersedia',
                'store_id'=>$daftar,
            ]);
    
            // $data_product->stok = $newStok;
            // $data_product->save();
        }else {
            $newStok = intval($data_product->stok) + intval($stock_masuk);
            // dd($data_product);

            $data_product = Size::where('id_product', $product_id)
        ->where('size', $pesanan->size)->where('store_id', $daftar)->update([
            'stok'=>$newStok,
        ]);
        }


        
        UangKeluar::create([
            'nominal'=>$pesanan->harga,
            'tanggal_pengeluaran'=>$pesanan->tanggal_pemesanan,
            'note'=>'restock',
            'store_id'=>$daftar,
            'qty'=>$pesanan->qty,
            'nama_admin'=>$nameadmin->name,
            'nama_product'=>$pesanan->nama_product,
        ]);


        PurchaseDetail::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product added to favourite successfully!');
    }
    public function removevalidator($id, Request $request)

    {
        $productId = $request->input('id');
    
    // Logic to remove the product from the cart
    PurchaseDetail::where('id', $id)->delete();
    
    // Redirect back to the cart page or any other appropriate page
    return redirect()->route('validator');

    }
    public function pesananaction(Request $request)
    {
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $pesanan = Keranjang::where('store_id', $store)->get();
        // dd($pesanan);
        // $uangkeluar=UangKeluar::create([
        //     'nominal'=>$request->subtotal,
        //     'tanggal_pengeluaran'=>$request->date,
        //     'note'=>'penjualan',
        //     'store_id'=>$store,
        //     'qty'=>1,
        // ]);
        $order=Order::create([
            'user_id'=>$user,
            'store_id'=>$store,
            'name_customer'=>$request->nama,
            'total'=>$request->subtotal,
            'qty'=>1,

        ]);
        if (isset($request->product_id)) {

            foreach ($request->product_id as $key => $value) {
                // dd($request->product_id);

                $produk = Size::where('id_product', $value)->where('id_product', $value)->first();
                // dd($value);
                OrderDetail::create([
                    'user_id'=>$user,
                    'order_id'=>$order->id,
                    'product_id'=>$value,
                    'store_id'=>$store,
                    'size'=>$produk->size,
                    'harga'=>$request->price[$key],
                    'status'=>'belum lunas',
                    'name_customer'=>$request->nama,
                    'tanggal_pemesanan'=>$request->date,
                    'qty'=>1,
                ]);
            }
        }
        
         Keranjang::whereIn('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
}
