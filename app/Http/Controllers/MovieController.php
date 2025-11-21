<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Seat;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('customer.booking', compact('movie'));
    }

    public function getSeats($movieId, $showtime)
    {
        $seats = Seat::where('movie_id', $movieId)
            ->where('showtime', $showtime)
            ->get();
        
        return response()->json($seats);
    }
}
