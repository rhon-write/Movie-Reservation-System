<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController
{
    public function index()
    {
        $movies = Movie::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.movies.index', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::with(['showTimes' => function($query) {
            $query->where('show_date', '>=', now()->toDateString())
                  ->orderBy('show_date')
                  ->orderBy('show_time');
        }])->findOrFail($id);

        return view('customer.movies.show', compact('movie'));
    }
}
