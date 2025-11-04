<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'genre',
        'duration',
        'rating',
        'image_url',
        'status',
    ];

    public function showTimes()
    {
        return $this->hasMany(ShowTime::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
