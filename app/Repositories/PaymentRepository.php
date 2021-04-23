<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function store($request, $transaction, string $status)
    {
        if(!empty($request->downPayment)){
            $price = $request->downPayment;
        } else {
            $price = $request->payment;
        }
        $payment = Payment::create([
            'user_id' => Auth()->user()->id,
            'transaction_id' => $transaction->id,
            'price' => $price,
            'status' => $status
        ]);

        return $payment;
    }
}
