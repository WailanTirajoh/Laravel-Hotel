<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'address',
        'job',
        'birthdate',
        'user_id',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterSearch($query){
        $query->when(request()->get('q'), function ($qr){
            $qr->where('name', 'Like', '%'.request()->get('q').'%')
                ->orWhere('id', 'Like', '%'.request()->get('q').'%');
        });
    }
}
