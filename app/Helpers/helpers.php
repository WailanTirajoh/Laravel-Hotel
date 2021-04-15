<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

function convertToRupiah($price)
{

    $price_rupiah = "Rp. " . number_format($price, 2, ',', '.');
    return $price_rupiah;
}

function dateFormat($date)
{
    return Carbon::parse($date)->isoFormat('D MMM YYYY');
}

function rrmdir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                filetype($dir . "/" . $object) == "dir" ?
                    rrmdir($dir . "/" . $object)
                    :
                    unlink($dir . "/" . $object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}

function getDateDifference($check_in, $check_out)
{
    $check_in = strtotime($check_in);
    $check_out = strtotime($check_out);
    $date_difference = $check_out - $check_in;
    $date_difference = round($date_difference / (60 * 60 * 24));
    return $date_difference;
}

function plural($value,$count){
    return Str::plural($value, $count);
}

function getColorByDay($day)
{
    $color = '';
    if($day==1) {
        $color = 'bg-danger';
    } else if($day>1 && $day<4) {
        $color = 'bg-warning';
    } else {
        $color = 'bg-success';
    }
    return $color;
}
