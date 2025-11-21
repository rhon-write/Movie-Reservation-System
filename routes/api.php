<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Routes for real-time seat updates
Route::get('/movies/{movieId}/seats/{showtime}', [MovieController::class, 'getSeats']);
