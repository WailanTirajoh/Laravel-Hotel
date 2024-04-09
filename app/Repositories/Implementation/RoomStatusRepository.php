<?php

namespace App\Repositories\Implementation;

use App\Models\RoomStatus;
use App\Repositories\Interface\RoomStatusRepositoryInterface;
use Illuminate\Http\Request;

class RoomStatusRepository implements RoomStatusRepositoryInterface
{
    /**
     * @deprecated since updated to getDatatable
     */
    public function getRoomStatuses(Request $request)
    {
        return RoomStatus::orderBy('id')
            ->when(! empty($request->search), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->search.'%');
            })
            ->paginate(5)
            ->appends($request->all());
    }

    public function getDatatable(Request $request)
    {
        $columns = [
            0 => 'room_statuses.id',
            1 => 'room_statuses.name',
            2 => 'room_statuses.code',
            3 => 'room_statuses.information',
            4 => 'room_statuses.id',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $main_query = RoomStatus::select(
            'room_statuses.id as number',
            'room_statuses.name',
            'room_statuses.code',
            'room_statuses.information',
            'room_statuses.id',
        );

        $totalData = $main_query->get()->count();

        $search = $request->input('search.value');
        $main_query->when(! empty($request->input('search.value')), function ($query) use ($search, $columns) {
            $query->where(function ($query) use ($search, $columns) {
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
        });

        $totalFiltered = $main_query->count();

        $data = $main_query->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get()
            ->map(function ($model) {
                return [
                    'number' => $model->id,
                    'name' => $model->name,
                    'code' => $model->code,
                    'information' => $model->information,
                    'id' => $model->id,
                ];
            });

        return json_encode([
            'draw' => intval($request->input('draw')),
            'iTotalRecords' => $totalData,
            'iTotalDisplayRecords' => $totalFiltered,
            'aaData' => $data,
        ]);
    }

    public function getRoomStatusList(Request $request)
    {
        return RoomStatus::get();
    }
}
