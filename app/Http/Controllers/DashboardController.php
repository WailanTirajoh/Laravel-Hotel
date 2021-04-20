<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $transactions = Transaction::with('user', 'room', 'customer')
            ->where([['check_in', '<=', $now], ['check_out', '>=', $now]])
            ->orderBy('check_out', 'ASC')
            ->orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.index', compact('transactions'));
    }
}
