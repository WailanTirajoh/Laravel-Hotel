<?php

namespace App\Repositories\Interface;

interface PaymentRepositoryInterface
{
    public function store($request, $transaction, string $status);
}
