<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Room;
use App\Models\RoomStatus;
use App\Models\Type;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('id', 'DESC')->paginate(5);
        return view('room.index', compact('rooms'));
    }

    public function create()
    {
        $types = Type::all();
        $roomstatuses = RoomStatus::all();
        return view('room.create', compact('types', 'roomstatuses'));
    }

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->all());
        return redirect()->route('room.index')->with('success', 'Room ' . $room->number . ' created');
    }

    public function edit(Room $room)
    {
        $types = Type::all();
        $roomstatuses = RoomStatus::all();
        return view('room.edit', compact('room', 'types', 'roomstatuses'));
    }

    public function update(Room $room, StoreRoomRequest $request)
    {
        $room->update($request->all());
        return redirect()->route('room.index')->with('success', 'Room ' . $room->name . ' udpated!');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('room.index')->with('success', 'Room number ' . $room->number . ' deleted!');
    }
}
