<?php

namespace App\Repositories\Interface;

use App\Models\Customer;
use App\Models\Room;

interface TransactionRepositoryInterface
{
    public function store($request, Customer $customer, Room $room);

    public function getTransaction($request);

    public function getTransactionExpired($request);
}
