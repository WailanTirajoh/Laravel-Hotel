<?php

namespace App\Repositories;

use App\Models\RoomStatus;

class RoomStatusRepository
{
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
}
