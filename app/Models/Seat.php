<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'showtime',
        'seat_number',
        'is_booked',
        'booked_by',
        'booking_id',
    ];

    protected $casts = [
        'is_booked' => 'boolean',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'booked_by');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
