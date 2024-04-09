<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Models\Image;
use App\Models\Room;
use App\Repositories\Interface\ImageRepositoryInterface;

class ImageController extends Controller
{
    public function __construct(
        private ImageRepositoryInterface $imageRepository
    ) {
    }

    public function store(StoreImageRequest $request, Room $room)
    {
        $path = public_path('img/room/'.$room->number);
        $file = $request->file('image');

        $lastFileName = $this->imageRepository->uploadImage($path, $file);

        Image::create([
            'room_id' => $room->id,
            'url' => $lastFileName,
        ]);

        return redirect()->route('room.show', ['room' => $room->id])->with('success', 'Image upload successfully!');
    }

    public function destroy(Image $image)
    {
        $path = public_path('img/room/'.$image->room->number.'/'.$image->url);
        if (file_exists($path)) {
            unlink($path);
        }
        $image->delete();

        return redirect()->back()->with('success', 'Image '.$image->url.' has been deleted!');
    }
}
