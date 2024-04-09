<?php

namespace App\Repositories\Implementation;

use App\Models\Payment;
use App\Repositories\Interface\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function store($request, $transaction, string $status)
    {
        return Payment::create([
            'user_id' => Auth()->user()->id,
            'transaction_id' => $transaction->id,
            'price' => empty($request->downPayment) ? $request->payment : $request->downPayment,
            'status' => $status,
        ]);
    }
}
