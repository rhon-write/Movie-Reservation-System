<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $movies = Movie::where('is_active', true)->get();
        return view('customer.dashboard', compact('movies'));
    }

    public function profile()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
            ->with('movie')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('customer.profile', compact('user', 'bookings'));
    }
}
