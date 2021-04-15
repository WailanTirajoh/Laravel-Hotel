<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function destroy(Image $image)
    {
        $path = 'img/room/' . $image->room->number . '/' . $image->url;
        unlink($path);
        $image->delete();
        return redirect()->back()->with('success', 'Image ' . $image->url . ' has been deleted!');
    }
}
