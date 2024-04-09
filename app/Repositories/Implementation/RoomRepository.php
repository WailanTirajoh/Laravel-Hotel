<?php

namespace App\Repositories\Implementation;

use App\Models\Room;
use App\Repositories\Interface\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    public function getRooms($request)
    {
        return Room::with('type', 'roomStatus')
            ->orderBy('number')
            ->when($request->status, function ($query) use ($request) {
                $query->where('room_status_id', $request->status);
            })
            ->when($request->type, function ($query) use ($request) {
                $query->where('type_id', $request->type);
            })
            ->when($request->search, function ($query) use ($request) {
                $query->where('number', 'LIKE', '%'.$request->search.'%');
            })
            ->paginate(5)
            ->appends($request->all());
    }

    public function getRoomsDatatable($request)
    {
        $columns = [
            0 => 'rooms.number',
            1 => 'types.name',
            2 => 'rooms.capacity',
            3 => 'rooms.price',
            4 => 'room_statuses.name',
            5 => 'types.id',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');
        $main_query = Room::select(
            'rooms.id',
            'rooms.number',
            'types.name as type',
            'rooms.capacity',
            'rooms.price',
            'room_statuses.name as status',
        )
            ->when($request->status !== 'All', function ($query) use ($request) {
                $query->where('room_status_id', $request->status);
            })
            ->when($request->type !== 'All', function ($query) use ($request) {
                $query->where('type_id', $request->type);
            })
            ->leftJoin('types', 'rooms.type_id', '=', 'types.id')
            ->leftJoin('room_statuses', 'rooms.room_status_id', '=', 'room_statuses.id');

        $totalData = $main_query->get()->count();

        $main_query->when($search, function ($query) use ($search, $columns) {
            $query->where(function ($q) use ($search, $columns) {
                $i = 0;
                foreach ($columns as $column) {
                    if ($i == 0) {
                        $q->where($column, 'LIKE', "%{$search}%");
                    } else {
                        $q->orWhere($column, 'LIKE', "%{$search}%");
                    }
                    $i++;
                }
            });
        });

        $totalFiltered = $main_query->count();

        $main_query->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir);

        $models = $main_query->get();

        $data = [];
        foreach ($models as $model) {
            $data[] = [
                'id' => $model->id,
                'number' => $model->number,
                'type' => $model->type,
                'price' => $model->price,
                'capacity' => $model->capacity,
                'status' => $model->status,
            ];
        }

        $response = [
            'draw' => intval($request->input('draw')),
            'iTotalRecords' => $totalData,
            'iTotalDisplayRecords' => $totalFiltered,
            'aaData' => $data,
        ];

        return json_encode($response);
    }
}
