<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Room;
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
        return view('room.create', compact('types'));
    }

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create([
            'type_id' => $request->type_id,
            'number' => $request->number,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'view' => $request->view
        ]);

        return redirect('room')->with('success', 'Room ' . $room->number . ' created');
    }

    public function edit(Room $room)
    {
        $types = Type::all();
        return view('room.edit', compact('room', 'types'));
    }

    public function update(Room $room, StoreRoomRequest $request)
    {
        $room->update($request->all());
        return redirect('room')->with('success', 'Room ' . $room->name . ' udpated!');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect('room')->with('success', 'Room number ' . $room->number . ' deleted!');
    }
}
