<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'room_status_id',
        'number',
        'capacity',
        'price',
        'view',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function roomStatus()
    {
        return $this->belongsTo(RoomStatus::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function firstImage()
    {
        if (count($this->image) > 0) {
            return $this->image->first()->getRoomImage();
        }

        return asset('img/default/default-room.png');
    }
}
