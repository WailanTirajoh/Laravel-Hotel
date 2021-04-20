<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request, TransactionRepository $transactionRepository)
    {
        $transactions = $transactionRepository->getTransaction($request);
        $transactionsExpired = $transactionRepository->getTransactionExpired($request);
        return view('transaction.index', compact('transactions', 'transactionsExpired'));
    }
}
