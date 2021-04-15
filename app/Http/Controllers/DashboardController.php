<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'room', 'customer')
            ->where('check_out', '>=', Carbon::now())
            ->orderBy('check_out', 'ASC')
            ->orderBy('id', 'DESC')->paginate(20);
        return view('dashboard.index', compact('transactions'));
    }



    public function dialyGuestPerMonth()
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');

        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $day_array = array();
        $guests_count_array = array();

        for($i=1; $i<=$days_in_month; $i++) {
            array_push($day_array,$i);
            array_push($guests_count_array,$this->countGuestsPerDay($year,$month,$i));
            // dd($this->countGuestsPerDay($year,$month,$i));
        }

        $max_no = max($guests_count_array);
        $max = round(($max_no+10/2)/10)*10;
        $dialyGuestPerMonth = array(
            'day' => $day_array,
            'guest_count_data' => $guests_count_array,
            'max' => $max
        );

        return $dialyGuestPerMonth;
    }

    public function countGuestsPerDay($year, $month, $day)
    {
        $time = strtotime($month.'/'.$day.'/'.$year);
        $date = date('Y-m-d',$time);
        $notAvailable = Transaction::where([['check_in','<=',$date],['check_out','>=',$date]])->count();

        return $notAvailable;
    }
}
