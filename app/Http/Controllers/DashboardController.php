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
}
