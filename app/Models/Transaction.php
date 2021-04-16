<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Helpers\Helper;

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
        $day = Helper::getDateDifference($check_in, $check_out);
        $total = $price * $day;
        return Helper::convertToRupiah($total);
    }

    public function getDateDifferenceWithPlural($check_in, $check_out)
    {
        $day = Helper::getDateDifference($check_in,$check_out);
        $plural = Str::plural('Day', $day);
        return $day.' '.$plural;
    }

}
