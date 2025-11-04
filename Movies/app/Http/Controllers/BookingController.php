<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\ShowTime;
use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController
{
    public function selectSeats($movieId, $showTimeId)
    {
        $movie = Movie::findOrFail($movieId);
        $showTime = ShowTime::with('movie')->findOrFail($showTimeId);
        $seats = Seat::where('show_time_id', $showTimeId)
            ->orderBy('seat_row')
            ->orderBy('seat_number')
            ->get();

        return view('customer.seats.select', compact('movie', 'showTime', 'seats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'show_time_id' => 'required|exists:show_times,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'seat_ids' => 'required|string',
            'total_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $seatIds = json_decode($validated['seat_ids'], true);
            
            if (!is_array($seatIds) || empty($seatIds)) {
                throw new \Exception('Please select at least one seat');
            }

            $booking = Booking::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'movie_id' => $validated['movie_id'],
                'show_time_id' => $validated['show_time_id'],
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'total_price' => $validated['total_price'],
                'status' => 'confirmed',
            ]);

            foreach ($seatIds as $seatId) {
                $seat = Seat::findOrFail($seatId);
                
                if (!$seat->is_available) {
                    throw new \Exception('Seat ' . $seat->seat_identifier . ' is no longer available');
                }
                
                $seat->update([
                    'is_available' => false,
                    'booking_id' => $booking->id,
                ]);
            }

            $showTime = ShowTime::findOrFail($validated['show_time_id']);
            $showTime->decrement('available_seats', count($seatIds));

            DB::commit();

            return redirect()->route('booking.confirmation', $booking->booking_id)
                ->with('success', 'Booking confirmed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Booking failed: ' . $e->getMessage())->withInput();
        }
    }

    public function confirmation($bookingId)
    {
        $booking = Booking::where('booking_id', $bookingId)
            ->with(['movie', 'showTime', 'seats'])
            ->firstOrFail();

        return view('customer.bookings.confirmation', compact('booking'));
    }
}
