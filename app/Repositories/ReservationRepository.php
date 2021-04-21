<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Room;

class ReservationRepository
{
    public function getUnocuppiedroom($request, $occupiedRoomId)
    {
        $rooms = Room::with('type', 'roomStatus')
            ->where('capacity', '>=', $request->count_person)
            ->whereNotIn('id', $occupiedRoomId);

        if (!empty($request->sort_name)) {
            $rooms = $rooms->orderBy($request->sort_name, $request->sort_type);
        }

        $rooms = $rooms
            ->orderBy('capacity')
            ->paginate(5);

        return $rooms;
    }

    public function countUnocuppiedroom($request, $occupiedRoomId)
    {
        return Room::with('type', 'roomStatus')
            ->where('capacity', '>=', $request->count_person)
            ->whereNotIn('id', $occupiedRoomId)
            ->orderBy('price')
            ->orderBy('capacity')
            ->count();
    }
}
