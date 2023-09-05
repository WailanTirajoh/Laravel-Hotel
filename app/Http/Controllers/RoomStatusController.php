<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomStatusRequest;
use App\Models\RoomStatus;
use App\Repositories\Interface\RoomStatusRepositoryInterface;
use Illuminate\Http\Request;

class RoomStatusController extends Controller
{
    private $roomStatusRepository;

    public function __construct(RoomStatusRepositoryInterface $roomStatusRepository)
    {
        $this->roomStatusRepository = $roomStatusRepository;
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
        $view = view('roomstatus.create')->render();
        return response()->json([
            'view' => $view,
        ]);
    }

    public function store(StoreRoomStatusRequest $request)
    {
        $roomstatus = RoomStatus::create($request->all());
        return response()->json([
            'message' => 'success', 'Room ' . $roomstatus->name . ' created'
        ]);
    }

    public function edit(RoomStatus $roomstatus)
    {
        $view = view('roomstatus.edit', compact('roomstatus'))->render();
        return response()->json([
            'view' => $view,
        ]);
    }

    public function update(StoreRoomStatusRequest $request, RoomStatus $roomstatus)
    {
        $roomstatus->update($request->all());
        return response()->json([
            'message' => 'success', 'Room ' . $roomstatus->name . ' udpated'
        ]);
    }

    public function destroy(RoomStatus $roomstatus)
    {
        try {
            $roomstatus->delete();
            return response()->json([
                'message' => 'Room ' . $roomstatus->name . ' deleted!'
            ]);
            return redirect()->route('roomstatus.index')->with('success', 'Room ' . $roomstatus->name . ' deleted!');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Type ' . $roomstatus->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]
            ], 500);
        }
    }
}
