<?php

namespace App\Repositories\Interface;

interface UserRepositoryInterface
{
    public function store($userData);

    public function showUser($request);

    public function showCustomer($request);
}
