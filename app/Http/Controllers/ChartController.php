<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function dialyGuestPerMonth()
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $day_array = array();
        $guests_count_array = array();

        for ($i = 1; $i <= $days_in_month; $i++) {
            array_push($day_array, $i);
            array_push($guests_count_array, $this->countGuestsPerDay($year, $month, $i));
        }

        $max_no = max($guests_count_array);
        $max = round(($max_no + 10 / 2) / 10) * 10;

        $dialyGuestPerMonth = array(
            'day' => $day_array,
            'guest_count_data' => $guests_count_array,
            'max' => $max
        );

        return $dialyGuestPerMonth;
    }

    private function countGuestsPerDay($year, $month, $day)
    {
        $time = strtotime($month . '/' . $day . '/' . $year);
        $date = date('Y-m-d', $time);

        $room_count = Transaction::where([['check_in', '<=', $date], ['check_out', '>=', $date]])->count();

        return $room_count;
    }

    public function dialyGuest($year,$month,$day)
    {
        $time = strtotime($month . '/' . $day . '/' . $year);
        $date = date('Y-m-d', $time);

        $transactions = Transaction::where([['check_in', '<=', $date], ['check_out', '>=', $date]])->get();

        return view('dashboard.chart_detail', compact('transactions','date'));
    }
}
