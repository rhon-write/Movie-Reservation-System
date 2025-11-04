<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'movie_id',
        'show_time_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'total_price',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_id)) {
                $booking->booking_id = 'BK' . time() . rand(100, 999);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function showTime()
    {
        return $this->belongsTo(ShowTime::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
