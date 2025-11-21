<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Booking;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'showtime' => 'required|string',
            'seats' => 'required|array|min:1',
            'seats.*' => 'required|string',
        ]);

        $movie = Movie::findOrFail($request->movie_id);
        $user = Auth::user();

        // Check if seats are available for this showtime
        $bookedSeats = Seat::where('movie_id', $movie->id)
            ->where('showtime', $request->showtime)
            ->whereIn('seat_number', $request->seats)
            ->where('is_booked', true)
            ->exists();

        if ($bookedSeats) {
            return redirect()->back()
                ->with('error', 'Some seats are already booked. Please select different seats.');
        }

        DB::beginTransaction();
        try {
            // Create booking
            $booking = Booking::create([
                'user_id' => $user->id,
                'movie_id' => $movie->id,
                'showtime' => $request->showtime,
                'seats' => $request->seats,
                'total_price' => count($request->seats) * $movie->price,
                'status' => 'pending',
            ]);

            // Mark seats as booked for this specific showtime
            foreach ($request->seats as $seatNumber) {
                Seat::updateOrCreate(
                    [
                        'movie_id' => $movie->id,
                        'showtime' => $request->showtime,
                        'seat_number' => $seatNumber,
                    ],
                    [
                        'is_booked' => true,
                        'booked_by' => $user->id,
                        'booking_id' => $booking->id,
                    ]
                );
            }

            // Send confirmation email
            try {
                Mail::to($user->email)->send(new BookingConfirmation($booking));
            } catch (\Exception $e) {
                // Log email error but continue with booking
                \Log::error('Email sending failed: ' . $e->getMessage());
            }

            DB::commit();

            return redirect('/customer/profile')
                ->with('success', 'Booking created successfully! Waiting for admin approval.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Booking failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to create booking. Please try again. Error: ' . $e->getMessage());
        }
    }
}
