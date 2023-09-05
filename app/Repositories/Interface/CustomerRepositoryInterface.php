<?php

namespace App\Repositories\Interface;

interface CustomerRepositoryInterface
{
    public function get($request);

    public function count($request);

    public static function store($request);
}
