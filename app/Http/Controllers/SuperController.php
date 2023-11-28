<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lunas;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SuperController extends Controller
{
    public function superadmin()
    {
        return view('superadmin');
    }
    public function formstore()
    {
        return view('formstore');
    }
    public function actionformstore(Request $request)
    {
        $user = Store::create([
            'name_store' => $request->name_store,
            'address' => $request->address,
            'name_owner' => $request->name_owner,
            'product_store' => $request->product_store,
        ]);
        


        Session::flash('message', 'Add Toko Selesai.');
        return redirect('formstore');
    }
    public function daftarstore()
    {
        $user = auth()->user()->id;
        $stores = Store::all();
        return view('daftarstore', compact('stores'));
    }
    public function daftaradmin()
    {
        $admins = User::where('is_superadmin', ('admin'))->get();
        return view('daftaradmin', compact('admins'));
    }
    // public function idadmin(Request $request)
    // {
    //     // dd($request->all()); 
    //     $admin = User::create([
    //         'store_id' => $request->store_id,
    //     ]);
        


    //     Session::flash('message', 'Add Toko Selesai.');
    //     return redirect('daftaradmin');
    // }
    public function show($id)
    {
        $detail = User::find($id);
        return view('show', compact('detail'));
    }
    public function actionid(Request $request)
    {
        User::where('id', $request->id)
              ->update(['store_id' => $request->store_id]);
        return redirect('/daftaradmin');

    }
    public function salesStatistics($id)
    {
        $products = Lunas::find($id)->select(Lunas::raw("COUNT(*) as count"), Lunas::raw("MONTHNAME(tanggal_pemesanan) as month_name"))

        ->whereYear('tanggal_pemesanan', date('Y'))

        ->groupBy(Lunas::raw("Month(tanggal_pemesanan)"))

        ->pluck('count', 'month_name');



        $labels = $products->keys();

        $data = $products->values();

  


        // dd($id);

        return view('statistics', compact('labels', 'data'));
    }

}
