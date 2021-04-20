<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use app\Helpers\ImageService;
use App\Models\Image;
use App\Models\Room;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create(Request $request, Room $room, ImageRepository $imageRepository)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg'
        ]);

        if ($request->hasFile('image')) {
            $path = 'img/room/' . $room->number;
            $path = public_path($path);
            $file = $request->file('image');

            $imageRepository->uploadImage($path, $file);

            Image::create([
                'room_id' => $room->id,
                'url' => $file->getClientOriginalName(),
            ]);
        }
        return redirect()->route('room.show', ['room' => $room->id])->with('success', 'Image upload successfully!');
    }

    public function destroy(Image $image)
    {
        $path = public_path('img/room/' . $image->room->number . '/' . $image->url);
        if (file_exists($path)) {
            unlink($path);
        }
        $image->delete();
        return redirect()->back()->with('success', 'Image ' . $image->url . ' has been deleted!');
    }
}
