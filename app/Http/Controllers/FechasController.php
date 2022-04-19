<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

class FechasController extends Controller
{
    public function fechavuelta(){

        $sat = new Carbon('next saturday');
        $sat = $sat->format('Y-m-d');
        // return $sat;
        $sun = new Carbon('next sunday');
        $sun = $sun->format('Y-m-d');

        $date = Carbon::now()->addDay(2)->format('Y-m-d');

        if ($date == $sat) {
            $fec = Carbon::now()->addDay(4)->format('Y-m-d');
            return $fec;
        }
        elseif ($date == $sun) {
            $fec = Carbon::now()->addDay(4)->format('Y-m-d');
            return $fec;
        } 
        else {
            return $date;
        }

    }

    public function fechaDoc(){

        $sat = new Carbon('next saturday');
        $sat = $sat->format('Y-m-d');
        $sun = new Carbon('next sunday');
        $sun = $sun->format('Y-m-d');
        $mon = new Carbon('next monday');
        $mon = $mon->format('Y-m-d');
        $tues = new Carbon('next tuesday');
        $tues = $tues->format('Y-m-d');

        $date = Carbon::now()->addDay(4)->format('Y-m-d');

        if ($date == $sat) {
            $fechaD = Carbon::now()->addDay(6)->format('Y-m-d');
            return $fechaD;
        }
        elseif ($date == $sun) {
            $fechaD = Carbon::now()->addDay(6)->format('Y-m-d');
            return $fechaD;
        }
        elseif ($date == $mon) {
            $fechaD = Carbon::now()->addDay(6)->format('Y-m-d');
            return $fechaD;
        }
        elseif ($date == $tues) {
            $fechaD = Carbon::now()->addDay(6)->format('Y-m-d');
            return $fechaD;
        }
        else {
            return $date;
        }
    }

    public function daysWeek(){
        
        $start = new DateTime(new Carbon('monday'));
        $end = new DateTime(new Carbon('sunday'));

        $end->modify('+1 day');

        $interval = $end->diff();

        $days = $interval->days;

        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        foreach ($period as $dt) {
            $curr = $dt->format('Y-m-d');

            if ($curr == 'Sat' || $curr == 'Sun') {
                $days++;
            }
            return $curr;
        }
    }
}
