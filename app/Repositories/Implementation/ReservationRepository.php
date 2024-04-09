<?php

namespace App\Repositories\Implementation;

use App\Models\Room;
use App\Repositories\Interface\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function getUnocuppiedroom($request, $occupiedRoomId)
    {
        return Room::with('type', 'roomStatus')
            ->where('capacity', '>=', $request->count_person)
            ->whereNotIn('id', $occupiedRoomId)
            ->when(! empty($request->sort_name), function ($query) use ($request) {
                $query->orderBy($request->sort_name, $request->sort_type);
            })
            ->orderBy('capacity')
            ->paginate(5);
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
