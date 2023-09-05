<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use app\Helpers\ImageService;
use App\Http\Requests\StoreImageRequest;
use App\Models\Image;
use App\Models\Room;
use App\Repositories\Interface\ImageRepositoryInterface;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function store(StoreImageRequest $request, Room $room)
    {
        $path = public_path('img/room/' . $room->number);
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
        $path = public_path('img/room/' . $image->room->number . '/' . $image->url);
        if (file_exists($path)) {
            unlink($path);
        }
        $image->delete();
        return redirect()->back()->with('success', 'Image ' . $image->url . ' has been deleted!');
    }
}
