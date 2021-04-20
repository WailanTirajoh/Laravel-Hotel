<?php

namespace App\Repositories;

use App\Models\Type;

class TypeRepository
{
    public function showAll($request)
    {
        $types = Type::orderBy('id', 'DESC');
        if (!empty($request->search)) {
            $types = $types->where('name', 'LIKE', '%' . $request->search . '%');
        }
        $types = $types->paginate(5);
        $types->appends($request->all());

        return $types;
    }
    public function store($typeData)
    {
        $type = new Type;
        $type->name = $typeData->name;
        $type->information = $typeData->information;
        $type->save();

        return $type;
    }
}
