<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function dailyGuestPerMonth()
    {
        $currentDate = Carbon::now();
        $daysInMonth = $currentDate->daysInMonth;

        $days = collect(range(1, $daysInMonth));
        $guests = $days
            ->map(function ($day) use ($currentDate) {
                return $this->dailyTotalGuests($currentDate->year, $currentDate->month, $day);
            })
            ->toArray();

        $max = (int) ceil((max($guests) + 10) / 10) * 10;

        return [
            'day' => $days->toArray(),
            'guest_count_data' => $guests,
            'max' => $max,
        ];
    }

    public function dailyGuest(Request $request)
    {
        $date = Carbon::createFromDate(
            year: $request->year,
            month: $request->month,
            day: $request->day
        );

        $transactions = Transaction::where('check_in', '<=', $date)
            ->where('check_out', '>=', $date)
            ->get();

        return view('dashboard.chart_detail', [
            'transactions' => $transactions,
            'date' => $date->format('Y-m-d'),
        ]);
    }

    private function dailyTotalGuests($year, $month, $day)
    {
        $date = Carbon::createFromDate($year, $month, $day);

        return Transaction::where('check_in', '<=', $date)
            ->where('check_out', '>=', $date)
            ->count();
    }
}
