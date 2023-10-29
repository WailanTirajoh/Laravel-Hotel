<?php

namespace App\Repositories\Interface;

interface RoomStatusRepositoryInterface
{
    /**
     * @deprecated since updated to getDatatable
     */
    public function getRoomStatuses($request);

    public function getDatatable($request);
    public function getRoomStatusList($request);
}
