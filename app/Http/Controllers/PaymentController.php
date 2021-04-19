<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('id','DESC')->paginate(5);
        return view('payment.index', compact('payments'));
    }

    public function create(Transaction $transaction)
    {
        return view('transaction.payment.create', compact('transaction'));
    }

    public function store(Transaction $transaction, Request $request)
    {
        $insufficient = $transaction->getTotalPrice($transaction->room->price, $transaction->check_in, $transaction->check_out) - $transaction->getTotalPayment();
        $request->validate([
            'payment' => 'required|numeric|lte:' . $insufficient
        ]);
        Payment::create([
            'user_id' => Auth()->user()->id,
            'transaction_id' => $transaction->id,
            'price' => $request->payment,
            'status' => 'Payment'
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaction room ' . $transaction->room->number . ' success, ' . Helper::convertToRupiah($request->payment) . ' paid');
    }

    public function invoice(Payment $payment)
    {
        return view('payment.invoice', compact('payment'));
    }
}
