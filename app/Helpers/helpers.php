<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class Helper
{
    public static function convertToRupiah($price)
    {
        $price_rupiah = "Rp. " . number_format($price, 2, ',', '.');
        return $price_rupiah;
    }

    public static function thisMonth()
    {
        return Carbon::parse(Carbon::now())->format('m');
    }

    public static function thisYear()
    {
        return Carbon::parse(Carbon::now())->format('Y');
    }

    public static function dateFormat($date)
    {
        return Carbon::parse($date)->isoFormat('D MMM YYYY');
    }

    public static function destroy($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    filetype($dir . "/" . $object) == "dir" ?
                        Helper::destroy($dir . "/" . $object)
                        :
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    public static function getDateDifference($check_in, $check_out)
    {
        $check_in = strtotime($check_in);
        $check_out = strtotime($check_out);
        $date_difference = $check_out - $check_in;
        $date_difference = round($date_difference / (60 * 60 * 24));
        return $date_difference;
    }

    public static function plural($value, $count)
    {
        return Str::plural($value, $count);
    }

    public static function getColorByDay($day)
    {
        $color = '';
        if ($day == 1) {
            $color = 'bg-danger';
        } else if ($day > 1 && $day < 4) {
            $color = 'bg-warning';
        } else {
            $color = 'bg-success';
        }
        return $color;
    }

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
}
