<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Transaction $transaction)
    {
        return view('transaction.payment.create', compact('transaction'));
    }
}
