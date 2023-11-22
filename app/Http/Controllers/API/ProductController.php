<?php

namespace App\Http\Controllers\API;


use App\Models\Size;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Keranjang;
use App\Models\UangKeluar;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\AktivityMasuk;
use App\Models\PurchaseDetail;
use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use App\Http\Controllers\API\BaseController;
use App\Models\LogProduct;
use App\Models\UangMasuk;
use Carbon\Carbon;

class ProductController extends BaseController
{
    public function produk()
    {
        //join
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
        //r1 aja
        $daftar = auth()->user()->store_id;
        $user = auth()->user()->store_id;
        $cart = Keranjang::where('store_id', $user)->get();
        // $customer = Customer::where('store_id', $daftar)->get();
        return $this->sendResponse($cart, 'Products retrieved successfully.');
    }

    public function hapus_action(Request $request){
        Keranjang::where('id', $request->id)->delete();
        return $this->sendResponse('succes', 'Products retrieved successfully.');
    }

    public function addToCart(Request $request)

    {
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
 
        $user = auth()->user()->id;
        $admin = User::where('id', $user)->first();
        //jam
        $tomorrow = now()->format('H:i:s');
        $formattedDate = now()->format('Y-m-d');
        $size = Size::whereIn('id', $request->size)->get();
        if ($request->hasFile('gambar')) {
            $destination_path = public_path('/gambar'); 
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
            $size = Size::create([
                    'id_product'=>$add->id,
                    'size'=>$request->size[$key],
                    'stok'=>$request->stok,
                    'status'=>'tersedia',
                    'store_id'=>$admin->store_id,
                ]);
            }
        }
             $log = LogProduct::create([
                     'store_id' =>$admin->store_id,
                     'name_product' =>$add->nama_product,
                     'name_admin' =>$admin->name,
                     'time' => $tomorrow,
                     'date' =>$formattedDate,
                     'price' => $add->harga,
                     'qty' => $size->stok,
        ]);
    

        
        
        return $this->sendResponse([$log, $size, $add], 'Products retrieved successfully.');

    }

    public function restock()
    {
        
        $daftar = auth()->user()->store_id;
        $product = Product::where('store_id', $daftar)->get();
        $size = PurchaseDetail::where('store_id', $daftar)->get();


        return $this->sendResponse( $size, 'Products retrieved successfully.');
    }

    public function restockaction(Request $request)
    {
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        $product = Product::find($request->id);
        $product_name = Product::where('nama_product','LIKE','%'.$request->name_product.'%')->first();
        $add = Purchase::create([
            'store_id'=>$store,
            'user_id'=>$user,
            'total_harga'=>$product->harga,
            'tanggal_pemesanan'=>$request->tanggal_pemesanan,
        ]);
        if (isset($request->id)) {
        $Purchase = PurchaseDetail::create([
                    'id_product'=>$product->id ?? $product_name->id,
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
         return $this->sendResponse([$Purchase, $add], 'Products retrieved successfully.');
    }

    public function data_validator()
    {
        
        $daftar = auth()->user()->store_id;
        $product = PurchaseDetail::where('store_id', $daftar)->get();
        return $this->sendResponse($product, 'Products retrieved successfully.');
    }

    public function removevalidator(Request $request)
    {
    $produk = PurchaseDetail::where('id', $request->id)->delete();
    return $this->sendResponse($produk, 'Products retrieved successfully.');

    }

    public function validatoraccept(Request $request)
    {
        $admin = auth()->user()->id;
        $nameadmin = User::where('id', $admin)->first();
        $daftar = auth()->user()->store_id;
        $pesanan = PurchaseDetail::where('id', $request -> id)->first();
        $stock_masuk = $request->qty;
        $product_id = $pesanan->id_product;
        $data_product = Size::where('id_product', $product_id)
        ->where('size', $pesanan->size)->where('store_id', $daftar)->first();
        if ($data_product === null) {
            $admin = Size::create([
                'id_product'=>$pesanan->id_product,
                'size'=>$pesanan->size,
                'stok'=>$pesanan->qty,
                'status'=>'tersedia',
                'store_id'=>$daftar,
            ]);
             
        }else{
            $newStok = intval($data_product->stok) + intval($stock_masuk);
            $data_product = Size::where('id_product', $product_id)
        ->where('size', $pesanan->size)->where('store_id', $daftar)->update([
            'stok'=>$newStok,
        ]);
        }
        $uangkeluar = UangKeluar::create([
                    'nominal'=>$pesanan->harga,
                    'tanggal_pengeluaran'=>$pesanan->tanggal_pemesanan,
                    'note'=>'restock',
                    'store_id'=>$daftar,
                    'nama_admin'=>$nameadmin->name,
                    'nama_product'=>$pesanan->nama_product,
                    'qty'=>$request->qty,
                    'total'=> $pesanan->harga * $pesanan->qty,
        ]);
        PurchaseDetail::where('id', $request -> id)->delete();
        return $this->sendResponse($uangkeluar, 'Products retrieved successfully.');
    }

    public function pesananction(Request $request)
    {
        $user = auth()->user()->id;
        $store = auth()->user()->store_id;
        // $admin = auth()->user()->name;
        // $formattedDate = now()->format('Y-m-d');
        $pesanan = Keranjang::whereIn('id', $request -> keranjang_id)->get();
        $total = 0;
        foreach ($pesanan as $key => $value) {
                $total += $value->harga;
                    }
        $order=Order::create([
            'user_id'=>$user,
            'store_id'=>$store,
            'name_customer'=>$request->nama,
            'total'=>$total,
            'qty'=>1,
        ]);
        
        if (isset($pesanan)) {
            foreach ($pesanan as $key => $value) {

                $product = Keranjang::where('id_product', $value)->where('id_product', $value)->first();
                $orderdetail = OrderDetail::create([
                    'user_id'=>$user,
                    'order_id'=>$order -> id,
                    'product_id'=>$value -> id_product ,
                    'store_id'=>$store,
                    'size'=>$value->ukuransepatu,
                    'harga'=>$value->harga,
                    'status'=>'belum lunas',
                    'name_customer'=>$request->nama,
                    'tanggal_pemesanan'=>$request->tanggal_pemesanan,
                    'qty'=>1,
                ]);

            }
        }

//         $log = UangMasuk::create([
//                 'store_id' =>$store,
//                 'name_customer' =>$order->name_customer,
//                 'tanggal' =>$formattedDate,
//                 'nominal' => $orderdetail->harga,
//                 'qty' => $orderdetail,
// ]);

           Keranjang::where('user_id', $user)->delete();
        return $this->sendResponse([$order, $orderdetail], 'Products retrieved successfully.');
    }
}
