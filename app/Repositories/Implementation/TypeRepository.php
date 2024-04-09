<?php

namespace App\Repositories\Implementation;

use App\Models\Type;
use App\Repositories\Interface\TypeRepositoryInterface;

class TypeRepository implements TypeRepositoryInterface
{
    public function showAll($request)
    {
        $types = Type::orderBy('id', 'DESC');
        if (! empty($request->search)) {
            $types = $types->where('name', 'LIKE', '%'.$request->search.'%');
        }
        $types = $types->paginate(5);
        $types->appends($request->all());

        return $types;
    }

    public function getTypesDatatable($request)
    {
        $columns = [
            0 => 'types.id',
            1 => 'types.name',
            2 => 'types.information',
            3 => 'types.id',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $main_query = Type::select(
            'types.id as number',
            'types.name',
            'types.information',
            'types.id',
        );

        $totalData = $main_query->get()->count();

        // Filter global column
        if ($request->input('search.value')) {
            $search = $request->input('search.value');
            $main_query->where(function ($query) use ($search, $columns) {
                $i = 0;
                foreach ($columns as $column) {
                    if ($i == 0) {
                        $query->where($column, 'LIKE', "%{$search}%");
                    } else {
                        $query->orWhere($column, 'LIKE', "%{$search}%");
                    }
                    $i++;
                }
            });
        }

        $totalFiltered = $main_query->count();

        $main_query->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir);

        $models = $main_query->get();

        $data = [];
        if (! empty($models)) {
            foreach ($models as $model) {
                $data[] = [
                    'number' => $model->id,
                    'name' => $model->name,
                    'information' => $model->information,
                    'id' => $model->id,
                ];
            }
        }

        $response = [
            'draw' => intval($request->input('draw')),
            'iTotalRecords' => $totalData,
            'iTotalDisplayRecords' => $totalFiltered,
            'aaData' => $data,
        ];

        return json_encode($response);
    }

    public function store($typeData)
    {
        $type = new Type;
        $type->name = $typeData->name;
        $type->information = $typeData->information;
        $type->save();

        return $type;
    }

    public function getTypeList($request)
    {
        return Type::get();
    }
}
