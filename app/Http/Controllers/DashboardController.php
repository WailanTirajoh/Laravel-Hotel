<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $date = Carbon::now();
        $transactions = Transaction::with('user', 'room', 'customer')
            ->where([['check_in', '<=', $date], ['check_out', '>=', $date]])
            ->orderBy('check_out', 'ASC')
            ->orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.index', compact('transactions'));
    }
}
