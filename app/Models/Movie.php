<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster',
        'showtimes',
        'price',
        'is_active',
    ];

    protected $casts = [
        'showtimes' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function availableSeats($showtime)
    {
        return $this->seats()
            ->where('showtime', $showtime)
            ->where('is_booked', false);
    }

    public function bookedSeats($showtime)
    {
        return $this->seats()
            ->where('showtime', $showtime)
            ->where('is_booked', true);
    }
}
