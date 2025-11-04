<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'show_date',
        'show_time',
        'price',
        'total_seats',
        'available_seats',
    ];

    protected $casts = [
        'show_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
