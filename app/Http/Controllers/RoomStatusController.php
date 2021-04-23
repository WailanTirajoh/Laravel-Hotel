<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomStatusRequest;
use App\Models\RoomStatus;
use App\Repositories\RoomStatusRepository;
use Illuminate\Http\Request;

class RoomStatusController extends Controller
{
    private $roomStatusRepository;

    public function __construct(RoomStatusRepository $roomStatusRepository)
    {
        $this->roomStatusRepository = $roomStatusRepository;
    }
    public function index(Request $request)
    {
        $roomstatuses = $this->roomStatusRepository->getRoomStatuses($request);
        return view('roomstatus.index', compact('roomstatuses'));
    }

    public function create()
    {
        return view('roomstatus.create');
    }

    public function store(StoreRoomStatusRequest $request)
    {
        $roomstatus = RoomStatus::create($request->all());
        return redirect()->route('roomstatus.index')->with('success', 'Room ' . $roomstatus->name . ' created');
    }

    public function edit(RoomStatus $roomstatus)
    {
        return view('roomstatus.edit', compact('roomstatus'));
    }

    public function update(StoreRoomStatusRequest $request, RoomStatus $roomstatus)
    {
        $roomstatus->update($request->all());
        return redirect()->route('roomstatus.index')->with('success', 'Room ' . $roomstatus->name . ' udpated!');
    }

    public function destroy(RoomStatus $roomstatus)
    {
        try {
            $roomstatus->delete();
            return redirect()->route('roomstatus.index')->with('success', 'Room ' . $roomstatus->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect()->route('roomstatus.index')->with('failed', 'Room ' . $roomstatus->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);;
        }
    }
}
