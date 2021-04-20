<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;
use Carbon\Carbon;

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

    public function getTransaction($request)
    {
        $transactions = Transaction::with('user', 'room', 'customer')->where('check_out', '>=', Carbon::now());

        if (!empty($request->search)) {
            $transactions = $transactions->where('id', '=', $request->search);
        }

        $transactions = $transactions->orderBy('check_out', 'ASC')->orderBy('id', 'DESC')->paginate(20);
        $transactions->appends($request->all());

        return $transactions;
    }

    public function getTransactionExpired($request)
    {
        $transactionsExpired = Transaction::with('user', 'room', 'customer')->where('check_out', '<', Carbon::now());

        if (!empty($request->search)) {
            $transactionsExpired = $transactionsExpired->where('id', '=', $request->search);
        }

        $transactionsExpired = $transactionsExpired->orderBy('check_out', 'ASC')->paginate(20);
        $transactionsExpired->appends($request->all());

        return $transactionsExpired;
    }
}
