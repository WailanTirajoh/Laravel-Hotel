<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomStatusRequest;
use App\Models\RoomStatus;
use App\Repositories\Interface\RoomStatusRepositoryInterface;
use Illuminate\Http\Request;

class RoomStatusController extends Controller
{
    public function __construct(
        private RoomStatusRepositoryInterface $roomStatusRepository
    ) {
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->roomStatusRepository->getDatatable($request);
        }

        return view('roomstatus.index');
    }

    public function create()
    {
        return response()->json([
            'view' => view('roomstatus.create')->render(),
        ]);
    }

    public function store(StoreRoomStatusRequest $request)
    {
        $roomstatus = RoomStatus::create($request->all());

        return response()->json([
            'message' => 'success', "Room $roomstatus->name created",
        ]);
    }

    public function edit(RoomStatus $roomstatus)
    {
        $view = view('roomstatus.edit', [
            'roomstatus' => $roomstatus,
        ])->render();

        return response()->json([
            'view' => $view,
        ]);
    }

    public function update(StoreRoomStatusRequest $request, RoomStatus $roomstatus)
    {
        $roomstatus->update($request->all());

        return response()->json([
            'message' => 'success', "Room $roomstatus->name udpated",
        ]);
    }

    public function destroy(RoomStatus $roomstatus)
    {
        try {
            $roomstatus->delete();

            return response()->json([
                'message' => "Room $roomstatus->name deleted!",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Type {$roomstatus->name} cannot be deleted! Error Code: {$e->errorInfo[1]}",
            ], 500);
        }
    }
}
