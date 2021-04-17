<?php

namespace app\Helpers;

use Intervention\Image\Facades\Image;

class ImageService
{
    public static function uploadImage($path, $file)
    {
        if (!is_dir($path)) {
            mkdir($path);
        }

        $url = $file->getClientOriginalName();
        $filename = pathinfo($url, PATHINFO_FILENAME);
        $urlExtension = $file->getClientOriginalExtension();

        $i = 0;
        $fullpathfile = $path . '/' . $url;
        while (file_exists($fullpathfile)) {
            $i++;
            $url = $filename . '-' . (string)$i . '.' . $urlExtension;
            $fullpathfile = $path . '/' . $url;
        }
        $img = Image::make($file->path());
        $img->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . '/' . $url);
    }

    public static function destroy($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    filetype($dir . "/" . $object) == "dir" ?
                        ImageService::destroy($dir . "/" . $object)
                        :
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}
