<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'url',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getRoomImage()
    {
        return asset('img/room/'.$this->room->number.'/'.$this->url);
    }
}
