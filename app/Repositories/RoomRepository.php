<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository
{
    public function getRooms($request)
    {
        $rooms = Room::with('type', 'roomStatus')->orderBy('number');
        if (!empty($request->search)) {
            $rooms = $rooms->where('number', 'LIKE', '%' . $request->search . '%');
        }
        $rooms = $rooms->paginate(5);
        $rooms->appends($request->all());

        return $rooms;
    }

    public function getRoomsDatatable($request)
    {
        $columns = array(
            0 => 'rooms.number',
            1 => 'types.name',
            2 => 'rooms.capacity',
            3 => 'rooms.price',
            4 => 'room_statuses.name',
            5 => 'types.id',
        );

        $limit          = $request->input('length');
        $start          = $request->input('start');
        $order          = $columns[$request->input('order.0.column')];
        $dir            = $request->input('order.0.dir');

        $main_query = Room::select(
            'rooms.id',
            'rooms.number',
            'types.name as type',
            'rooms.capacity',
            'rooms.price',
            'room_statuses.name as status',
        )
            ->leftJoin("types", "rooms.type_id", "=", "types.id")
            ->leftJoin("room_statuses", "rooms.room_status_id", "=", "room_statuses.id");

        $totalData  =   $main_query->get()->count();

        // Filter global column
        if ($request->input('search.value')) {
            $search = $request->input('search.value');
            $main_query->where(function ($query) use ($search, $columns) {
                $i = 0;
                foreach ($columns as $column) {
                    if ($i = 0) {
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
        if (!empty($models)) {
            foreach ($models as $model) {
                $data[] = array(
                    "id" => $model->id,
                    "number" => $model->number,
                    "type" => $model->type,
                    "price" => $model->price,
                    "capacity" => $model->capacity,
                    "status" => $model->status,
                );
            }
        }

        $response = array(
            "draw" => intval($request->input('draw')),
            "iTotalRecords" => $totalData,
            "iTotalDisplayRecords" => $totalFiltered,
            "aaData" => $data
        );

        return json_encode($response);
    }
}
