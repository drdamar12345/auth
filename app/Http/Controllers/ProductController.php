<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\User;
use App\Models\Order;
use App\Models\Store;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Keranjang;
use App\Models\PattyCash;
use App\Models\LogProduct;
use App\Models\UangKeluar;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use App\Models\LogProductDetail;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function produk()
    {
        $user = auth()->user()->store_id;
        $data = Product::where('store_id', $user)->get();

        $product = $data->map(function ($q) {
            $stok = Size::where('id_product', $q->id)->get()->sum('stok');
            $size = Size::where('id_product', $q->id)->where('stok', '>', 1)->get();

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
        $size = Size::where('id', $request->ukuransepatu)->first();
        // dd($size);        
        $admin = Keranjang::create([
            'id_product'=>$product->id,
            'nama_product'=>$product->nama_product,
            'gambar'=>$product->gambar,
            'harga'=>$size->price,
            'user_id'=>$user,
            'qty'=>1,
            'ukuransepatu'=>$size->size,
            'store_id'=>$id->store_id,
        ]);
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
    public function getPrice($id, Request $request)
    {
        // dd($id);
        $product = Size::where('id', $id)
                            ->first();

        if ($product) {
            return response()->json(['price' => $product]);
        }

        return response()->json(['price' => 'Product not found']);
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
        $store = auth()->user()->store_id;
        $user = auth()->user();
        $admin = User::where('id', $user->id)->first();
        if (isset($request->size)) {
            foreach ($request->size as $key => $value) {
                LogProductDetail::create([
                    'name_product'=>$request->nama_product,
                    'size'=>$value,
                    'price'=>$request->price[$key],
                    'store_id'=>$admin->store_id,
                    'qty'=>$request->stok[$key],
                    'time'=>Carbon::now()->format('H:i'),
                    'date'=>Carbon::now()->format('Y-m-d'),
                    'name_admin'=>$user->name,
                    'note'=>'+ add product',
                    'total'=>$request->price[$key] * $request->stok[$key], 
                ]);
            }
        }
        $add=Product::create([
            'nama_product'=>$request->nama_product,
            'merk'=>$request->merk,
            'warna'=>$request->warna,
            'gambar'=>$request->gambar,
            'store_id'=>$admin->store_id,

        ]);
        if (isset($request->size)) {
            foreach ($request->size as $key => $value) {
                // dd($value);
                Size::create([
                    'id_product'=>$add->id,
                    'size'=>$value,
                    'stok'=>$request->stok[$key],
                    'status'=>'tersedia',
                    'store_id'=>$admin->store_id,
                    'price'=>$request->price[$key],
                ]);
            }
        }
        
        return redirect()->back()->with('success', 'Add New Product');

    }
    public function restock()
    {
        
        $daftar = auth()->user()->id;
        $store = auth()->user()->store_id;
        $product = Product::where('store_id', $store)->get();
        return view('restock', compact('product'));
    }
    public function restockaction(Request $request)
    {
        // dd($request->all());
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $product = Product::where('id', $request->nama)->get();
        // dd($product);
        $admin = User::where('id', $user)->first();
        if (isset($request->size)) {
            // foreach ($request->size as $key => $value) {
                // dd($request);
                $add=Purchase::create([
                    'store_id'=>$store,
                    'user_id'=>$user,
                    'total_harga'=>(int)$request->price[0] * (int)$request->qty[0],
                    'tanggal_pemesanan'=>$request->tanggal_pemesanan,
                ]);
            // }
        }
        if (isset($request->nama)) {
            foreach ($request->size as $key => $value) {
                // dd($value);
                PurchaseDetail::create([
                    'id_product'=>$product[$key]->id,
                    'store_id'=>$store,
                    'purchase_id'=>$add->id,
                    'size'=>$request->size[$key],
                    'qty'=>$request->qty[$key],
                    'harga'=>$request->price[$key],
                    'status'=>'dikirim',
                    'nama_product'=>$product[$key]->nama_product,
                    'tanggal_pemesanan'=>$request->tanggal_pemesanan,
                ]);
            }

        }
        
        return redirect()->back()->with('success', 'Add New Product');

    }

    public function validator()
    {
        $daftar = auth()->user()->id;
        $store = auth()->user()->store_id;
        $pesanan = PurchaseDetail::where('store_id', $store)->get();
        return view('validator', compact('pesanan'));
    }
    public function validatoraccept($id)
    {
        $admin = auth()->user()->id;
        $nameadmin = User::where('id', $admin)->first();
        $daftar = auth()->user()->store_id;
        $pesanan = PurchaseDetail::where('id', $id)->first();
        $cash = Store::where('id', $pesanan->store_id)->first();
        // dd($cash);
        // dd($pesanan);
        $stock_masuk = $pesanan->qty;
        // dd($stock_masuk);
        $product_id = $pesanan->id_product;
        
        $data_product = Size::where('id_product', $product_id)
        ->where('size', $pesanan->size)->where('store_id', $daftar)->first();

        $data_product_price = Size::where('id_product', $product_id)
        ->where('size', $pesanan->size)->where('store_id', $daftar)->first();
        // dd($data_product);
        if ($data_product === null) {
            $admin = Size::create([
                'id_product'=>$pesanan->id_product,
                'size'=>$pesanan->size,
                'stok'=>$pesanan->qty,
                'status'=>'tersedia',
                'store_id'=>$daftar,
                'price'=>$pesanan->harga,
            ]);
    
            // $data_product->stok = $newStok;
            // $data_product->save();
        }else {
            $newStok = intval($data_product->stok) + intval($stock_masuk);
            $newPrice = $pesanan->harga;
            $prices = $pesanan->harga * $pesanan->qty;
            $newCash = intval($cash->patty_cash) - intval($prices);

            // dd($newCash);
            // dd($data_product);

            $data_product = Size::where('id_product', $product_id)
        ->where('size', $pesanan->size)->where('store_id', $daftar)->update(['stok'=>$newStok,]);
        $new_data_price = Size::where('id_product', $product_id)->where('size', $pesanan->size)->where('store_id', $daftar)->update(['price'=>$pesanan->harga]);
        Store::where('id', $pesanan->store_id)
              ->update([
                'patty_cash' => $newCash]);
        // dd($new_data_price);
        }


        
        UangKeluar::create([
            'nominal'=>$pesanan->harga,
            'tanggal_pengeluaran'=>$pesanan->tanggal_pemesanan,
            'note'=>'restock',
            'store_id'=>$daftar,
            'qty'=>$pesanan->qty,
            'nama_admin'=>$nameadmin->name,
            'name_product'=>$pesanan->nama_product,
            'total'=> $pesanan->harga * $pesanan->qty,
            'time'=>Carbon::now()->format('H:i'),
            'size'=>$pesanan->size,
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
        // dd($request->all);

        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $pesanan = Keranjang::where('store_id', $store)->get();
        $order=Order::create([
            'user_id'=>$user,
            'store_id'=>$store,
            'name_customer'=>$request->nama,
            'total'=>$request->subtotal,
            'qty'=>$request->total_qty,
            'date'=>Carbon::now()->format('Y-m-d'),
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
                    'tanggal_pemesanan'=>Carbon::now()->format('Y-m-d'),
                    'qty'=>1,
                ]);
            }
        }
        
         Keranjang::whereIn('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
    public function addpettycash(Request $request)
    {
        // dd($request->all);

        $daftar = auth()->user()->id;
        $store = auth()->user()->store_id;
        $name = auth()->user()->name;
        Store::where('id', $request->store_id)
              ->update([
                'patty_cash' => $request->patty_cash]);
        $add= PattyCash::create([
            'name_admin' => $name,
            'nominal' => $request->patty_cash,
            'date' => Carbon::now()->format('Y-m-d'),
            'store_id' => $store,
        
        ]);
        $frequentlyOrderedProducts = OrderDetail::select('product_id', \DB::raw('COUNT(*) as total_orders'))
            ->groupBy('product_id')
            ->orderByDesc('total_orders')
            ->limit(3) // Ubah sesuai kebutuhan
            ->get();
        // dd($frequentlyOrderedProducts);
        // Mengambil informasi produk berdasarkan hasil query sebelumnya
        $products = [];
        foreach ($frequentlyOrderedProducts as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->total_orders = $item->total_orders;
                $products[] = $product;
                // dd($product);
            }
        }
        $cash = Store::where('id', $store)->get();
        return view('home', compact('products', 'cash'));
    }
    public function mostcheckout()
    {
        $daftar = auth()->user()->id;
        $store = auth()->user()->store_id;
        $cash = Store::where('id', $store)->get();
        // Mengambil data produk yang sering dipesan dari order detail
        $frequentlyOrderedProducts = OrderDetail::select('product_id', \DB::raw('COUNT(*) as total_orders'))
            ->groupBy('product_id')
            ->orderByDesc('total_orders')
            ->limit(3) // Ubah sesuai kebutuhan
            ->get();
        // dd($frequentlyOrderedProducts);
        // Mengambil informasi produk berdasarkan hasil query sebelumnya
        $products = [];
        foreach ($frequentlyOrderedProducts as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->total_orders = $item->total_orders;
                $products[] = $product;
                // dd($product);
            }
        }
        // $stockminim = Size::where('store_id', $store)->get();
        $stockminims = Size::
        leftJoin('tb_product_utama', 'tb_product_utama.id', 'tb_size.id_product')
        ->select(
            'tb_size.id_product',
            'tb_size.size',
            'tb_size.stok',
            'tb_size.status',
            'tb_size.store_id',
            'tb_size.price',
            'tb_product_utama.nama_product',
            'tb_product_utama.gambar',
            'tb_product_utama.merk',
        ) 
        ->where('stok', '<', 3)->where('tb_size.store_id', $store)->get();   
        return view('home', compact('products', 'cash', 'stockminims'));
    }
}
