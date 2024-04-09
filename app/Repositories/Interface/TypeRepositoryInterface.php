<?php

namespace App\Repositories\Interface;

interface TypeRepositoryInterface
{
    public function showAll($request);

    public function getTypesDatatable($request);

    public function store($typeData);

    public function getTypeList($request);
}
