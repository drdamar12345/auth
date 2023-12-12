<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Lunas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticController extends Controller
{
    public function weeklystatistic()
    {
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
                // dd($label);
                $value[] = $company;
                // dd($company);
            }
    return view('coba', compact('label', 'value'));    }
}
