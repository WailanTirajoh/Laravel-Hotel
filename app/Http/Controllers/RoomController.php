<?php

namespace App\Http\Controllers;

use app\Helpers\ImageService;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Image;
use App\Models\Room;
use App\Models\RoomStatus;
use App\Models\Type;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::with('type', 'roomStatus')->orderBy('number');
        if (!empty($request->search)) {
            $rooms = $rooms->where('number', 'LIKE', '%' . $request->search . '%');
        }
        $rooms = $rooms->paginate(5);
        $rooms->appends($request->all());
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

    public function show(Room $room)
    {
        $roomimages = Image::where('room_id', $room->id)->get();
        return view('room.show', compact('room', 'roomimages'));
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
        try {
            $room->delete();

            $path = 'img/room/' . $room->number;
            $path = public_path($path);

            if (is_dir($path)) {
                ImageService::destroy($path);
            }

            return redirect()->route('room.index')->with('success', 'Room number ' . $room->number . ' deleted!');
        } catch (\Exception $e) {
            return redirect()->route('room.index')->with('failed', 'Customer ' . $room->number . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);
        }
    }
}
