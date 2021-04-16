<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Room;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as ImageUpload;

class ImageController extends Controller
{
    public function create(Request $request, Room $room)
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
