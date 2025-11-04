<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Movie;
use Illuminate\Http\Request;

class AdminDashboardController
{
    public function dashboard()
{
    $totalBookings = Booking::count();
    $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');
    $totalMovies = Movie::where('status', 'active')->count();
    $totalSeatsBooked = Booking::where('status', 'confirmed')
        ->withCount('seats')
        ->get()
        ->sum('seats_count');

    $recentBookings = Booking::with(['movie', 'showTime', 'seats'])
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    return view('admin.dashboard', compact(
        'totalBookings',
        'totalRevenue',
        'totalMovies',
        'totalSeatsBooked',
        'recentBookings'
    ));
}


    public function reservations(Request $request)
    {
        $query = Booking::with(['movie', 'showTime', 'seats', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('booking_id', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.reservations', compact('bookings'));
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        
        $booking->update(['status' => 'cancelled']);
        
        foreach ($booking->seats as $seat) {
            $seat->update([
                'is_available' => true,
                'booking_id' => null,
            ]);
        }

        $booking->showTime->increment('available_seats', $booking->seats->count());

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function export()
    {
        $bookings = Booking::with(['movie', 'showTime', 'seats'])->get();

        $filename = 'bookings_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($bookings) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, ['Booking ID', 'Customer Name', 'Email', 'Phone', 'Movie', 'Date', 'Time', 'Seats', 'Total Price', 'Status']);

            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->booking_id,
                    $booking->customer_name,
                    $booking->customer_email,
                    $booking->customer_phone,
                    $booking->movie->title,
                    $booking->showTime->show_date->format('Y-m-d'),
                    date('h:i A', strtotime($booking->showTime->show_time)),
                    $booking->seats->pluck('seat_identifier')->implode(', '),
                    $booking->total_price,
                    $booking->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
