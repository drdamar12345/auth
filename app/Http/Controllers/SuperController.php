<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\User;
use App\Models\Lunas;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                // dd($id);
        // $products = Lunas::select(DB::raw("COUNT(id) as count"),DB::raw("MONTHNAME(tanggal_pemesanan) as s"))

        // ->whereDate('tanggal_pemesanan', date('Y/m/d'))

        // ->where('store_id', $id)


        // ->groupBy("tanggal_pemesanan")

        // ->pluck('count');
        // $result = $product ->map

        // ->whereDate('tanggal_pemesanan', date('d'))

        // ->groupBy('tanggal_pemesanan')

        // ->pluck('count', 'tanggal_pemesanan')->where($id)->first();

        // dd($products);

        // $labels = $products->keys();

        // $data = $products->values();

        
            $today = date("l");
            if($today == "Monday"){
                $start_date = date("Y-m-d");
                $end_date = date("Y-m-d", strtotime("tomorrow"));
            }else{
                $start_date = date("Y-m-d", strtotime("previous monday"));
                $end_date = date("Y-m-d", strtotime("tomorrow"));
            }

            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1D'),
                new DateTime($end_date)
           );

            $label = [];
            $value = [];
            foreach ($period as $key => $val) {
                // dd($period);
                $company = Lunas::whereDate('tanggal_pemesanan',$val->format('Y-m-d'));                    
                    if($val->format('l') == 'Sunday'){
                        $day = 'Minggu';
                    }elseif($val->format('l') == 'Monday'){
                        $day = 'Senin';
                    }elseif($val->format('l') == 'Tuesday'){
                        $day = 'Selasa';
                    }elseif($val->format('l') == 'Wednesday'){
                        $day = 'Rabu';
                    }elseif($val->format('l') == 'Thursday'){
                        $day = 'Kamis';
                    }elseif($val->format('l') == 'Friday'){
                        $day = 'Jumat';
                    }elseif($val->format('l') == 'Saturday'){
                        $day = 'Sabtu';
                    }else{
                        $day = '';
                    }
                  
                $label[] = '('.$day.') '.$val->format('d M Y');
                dd($label);
                $value[] = $company;
            }

        

  



        return view('statistics', compact('label', 'value'));
    }

}
