<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::with('user', 'room', 'customer')->where('check_out', '>=', Carbon::now());
        $transactionsExpired = Transaction::with('user', 'room', 'customer')->where('check_out', '<', Carbon::now());

        if (!empty($request->search)) {
            $transactions = $transactions->where('id', '=', $request->search);
            $transactionsExpired = $transactionsExpired->where('id', '=', $request->search);
        }

        $transactions = $transactions->orderBy('check_out', 'ASC')->orderBy('id', 'DESC')->paginate(20);
        $transactionsExpired = $transactionsExpired->orderBy('id', 'DESC')->paginate(20);

        $transactions->appends($request->all());
        $transactionsExpired->appends($request->all());
        return view('transaction.index', compact('transactions', 'transactionsExpired'));
    }
}
