<?php

namespace App\Repositories\Implementation;

use App\Models\RoomStatus;
use App\Repositories\Interface\RoomStatusRepositoryInterface;

class RoomStatusRepository implements RoomStatusRepositoryInterface
{
    /**
     * @deprecated since updated to getDatatable
     */
    public function getRoomStatuses($request)
    {
        $roomStatuses = RoomStatus::orderBy('id');

        if (!empty($request->search)) {
            $roomStatuses = $roomStatuses->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $roomStatuses = $roomStatuses->paginate(5);
        $roomStatuses->appends($request->all());

        return $roomStatuses;
    }

    public function getDatatable($request)
    {
        $columns = array(
            0 => 'room_statuses.id',
            1 => 'room_statuses.name',
            2 => 'room_statuses.code',
            3 => 'room_statuses.information',
            4 => 'room_statuses.id',
        );

        $limit          = $request->input('length');
        $start          = $request->input('start');
        $order          = $columns[$request->input('order.0.column')];
        $dir            = $request->input('order.0.dir');

        $main_query = RoomStatus::select(
            'room_statuses.id as number',
            'room_statuses.name',
            'room_statuses.code',
            'room_statuses.information',
            'room_statuses.id',
        );

        $totalData = $main_query->get()->count();

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
                    "number" => $model->id,
                    "name" => $model->name,
                    "code" => $model->code,
                    "information" => $model->information,
                    "id" => $model->id,
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

    public function getRoomStatusList($request)
    {
        return RoomStatus::get();
    }
}
