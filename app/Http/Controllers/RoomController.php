<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Image;
use App\Models\Room;
use App\Models\RoomStatus;
use App\Models\Type;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as ImageUpload;

use function PHPUnit\Framework\fileExists;

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

    public function show(Room $room)
    {
        $roomimages = Image::where('room_id', $room->id)->get();
        return view('room.show', compact('room','roomimages'));
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

    public function imageUpload(Request $request, Room $room)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg'
        ]);

        if ($request->hasFile('image')) {
            $path = 'img/room/' . $room->number;
            $path = public_path($path);
            $file = $request->file('image');
            // Check if folder not exists then create folder
            if (!is_dir($path)) {
                mkdir($path);
            }
            $url = $file->getClientOriginalName();
            $filename = pathinfo($url, PATHINFO_FILENAME);
            $urlExtension = $file->getClientOriginalExtension();

            $fullpathfile = $path . '/' . $url;
            $i = 0;
            // dd(file_exists($fullpathfile));
            while (file_exists($fullpathfile)) {
                $i++;
                $url = $filename . '-' . (string)$i . '.' . $urlExtension;
                $fullpathfile = $path . '/' . $url;
            }
            $img = ImageUpload::make($file->path());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . '/' . $url);
            Image::create([
                'room_id' => $room->id,
                'url' => $url,
            ]);
        }


        return redirect()->route('room.show', ['room' => $room->id])->with('success', 'Image upload successfully!');
    }
}
