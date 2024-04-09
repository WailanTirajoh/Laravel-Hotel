<?php

namespace App\Models;

use App\Helpers\Helper;
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
        'status',
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

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalPrice()
    {
        $day = Helper::getDateDifference($this->check_in, $this->check_out);
        $room_price = $this->room->price;

        return $room_price * $day;
    }

    public function getDateDifferenceWithPlural()
    {
        $day = Helper::getDateDifference($this->check_in, $this->check_out);
        $plural = Str::plural('Day', $day);

        return $day.' '.$plural;
    }

    public function getTotalPayment()
    {
        $totalPayment = 0;
        foreach ($this->payment as $payment) {
            $totalPayment += $payment->price;
        }

        return $totalPayment;
    }

    public function getMinimumDownPayment()
    {
        $dayDifference = Helper::getDateDifference($this->check_in, $this->check_out);

        return ($this->room->price * $dayDifference) * 0.15;
    }
}
