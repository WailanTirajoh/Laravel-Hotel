<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'information',
    ];

    public function scopeFilterSearch($query){
        $query->when(request()->get('search'), function ($qr){
            $qr->where('name', 'LIKE', '%'.request()->get('search').'%');
        });
    }
}
