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
}
