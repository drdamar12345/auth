<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Lunas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatisticController extends Controller
{
    public function weeklystatistic()
    {
        \DB::statement("SET SQL_MODE=''");
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
            $value = null;
            foreach ($period as $key => $val) {
                // dd($period);
                // $company = Lunas::whereDate('tanggal_pemesanan',$val->format('Y-m-d'));                    
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
                    // $company = $company->select(DB::raw('WEEK(tanggal_pemesanan) as week_number, COUNT(*) as total'))
                    // ->groupBy(DB::raw('WEEK(created_at)'))
                    // ->get();
                    $company =  Lunas::select(DB::raw('WEEK(tanggal_pemesanan) as week_number, COUNT(*) as total'))
                ->groupBy(DB::raw('WEEK(created_at)'))
                ->get()->toArray();
                  
                $label[] = '('.$day.') '.$val->format('d M Y');
                // dd($label);

                $data = $company;

                $hasil = [];

                foreach ($data as $key => $value) {
                    $hasil[$key] = $value['total'];
                }
                $value = $hasil;
                // dd($value);
            }
    return view('home', compact('label', 'value'));    }
}
