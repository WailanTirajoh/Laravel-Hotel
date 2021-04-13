<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'room_id',
        'check_in',
        'check_out',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getTotalPayment($price, $check_in, $check_out)
    {
        $day = $this->getDateDifference($check_in, $check_out);
        $total = $price * $day;
        return $this->convertToRupiah($total);
    }

    public function getDateDifference($check_in, $check_out)
    {
        $day = (int)Carbon::parse($check_in)->diff($check_out)->format('%d');
        return $day;
    }

    public function getDateDifferenceWithPlural($check_in, $check_out)
    {
        $day = $this->getDateDifference($check_in,$check_out);
        $plural = Str::plural('Day', $day);
        return $day.' '.$plural;
    }

    private function convertToRupiah($price)
    {

        $price_rupiah = "Rp. " . number_format($price, 2, ',', '.');
        return $price_rupiah;
    }

    public static function dateFormat($date)
    {
        return Carbon::parse($date)->isoFormat('D MMM YYYY');
    }
}
