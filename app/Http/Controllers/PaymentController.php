<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Repositories\Interface\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentRepositoryInterface $paymentRepository
    ) {
    }

    public function index()
    {
        $payments = Payment::orderBy('id', 'DESC')->paginate(5);

        return view('payment.index', ['payments' => $payments]);
    }

    public function create(Transaction $transaction)
    {
        return view('transaction.payment.create', [
            'transaction' => $transaction,
        ]);
    }

    public function store(Transaction $transaction, Request $request)
    {
        $insufficient = $transaction->getTotalPrice() - $transaction->getTotalPayment();
        $request->validate([
            'payment' => 'required|numeric|lte:'.$insufficient,
        ]);

        $this->paymentRepository->store($request, $transaction, 'Payment');

        return redirect()->route('transaction.index')->with('success', 'Transaction room '.$transaction->room->number.' success, '.Helpers::convertToRupiah($request->payment).' paid');
    }

    public function invoice(Payment $payment)
    {
        return view('payment.invoice', [
            'payment' => $payment,
        ]);
    }
}
