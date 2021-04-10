<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Type;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(5);
        return view('room.index', [
            'rooms' => $rooms
        ]);
    }

    public function add()
    {
        $types = Type::all();
        return view('room.add', [
            'types' => $types
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'number' => 'required|unique:rooms,number',
            'capacity' => 'required|numeric',
            'price' => 'required|numeric',
            'view' => 'required|max:255'
        ]);

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
        return view('room.edit', [
            'room' => $room,
            'types' => $types
        ]);
    }

    public function update(Room $room, Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'number' => 'required|unique:rooms,number,'.$room->id,
            'capacity' => 'required|numeric',
            'price' => 'required|numeric',
            'view' => 'required|max:255'
        ]);

        $room->update($request->all());
        return redirect('room')->with('success', 'Room ' . $room->name . ' udpated!');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect('room')->with('success', 'Room ' . $room->name . ' deleted!');
    }
}
