<?php

namespace App\Repositories\Interface;

interface ReservationRepositoryInterface
{
    public function getUnocuppiedroom($request, $occupiedRoomId);

    public function countUnocuppiedroom($request, $occupiedRoomId);
}
