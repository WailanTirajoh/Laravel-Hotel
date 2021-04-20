<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;

class TransactionRepository
{
    public function store($request, Customer $customer, Room $room)
    {
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $customer->id,
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'Reservation'
        ]);

        return $transaction;
    }
}
