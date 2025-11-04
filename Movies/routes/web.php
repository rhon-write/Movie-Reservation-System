<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', function () {
    $movies = \App\Models\Movie::where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->get();
    return view('welcome', compact('movies'));
})->name('home');

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

/*
|--------------------------------------------------------------------------
| Customer Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('customer')->group(function () {
    Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
    Route::post('/login', [CustomerAuthController::class, 'login']);
    Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
    Route::post('/register', [CustomerAuthController::class, 'register']);
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
});

Route::middleware(['customer'])->prefix('booking')->group(function () {
    Route::get('/seats/{movie}/{showtime}', [BookingController::class, 'selectSeats'])->name('booking.selectSeats');
    Route::post('/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/confirmation/{bookingId}', [BookingController::class, 'confirmation'])->name('booking.confirmation');
});


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/reservations', [AdminDashboardController::class, 'reservations'])->name('admin.reservations');
        Route::post('/reservations/{id}/cancel', [AdminDashboardController::class, 'cancel'])->name('admin.reservations.cancel');
        Route::get('/export/reservations', [AdminDashboardController::class, 'export'])->name('admin.export.reservations');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
