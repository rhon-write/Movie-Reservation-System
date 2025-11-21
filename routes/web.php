<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('home');
});

// Customer Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Authentication Routes (Hidden from customers)
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

// Customer Routes (Protected by CustomerMiddleware)
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.show');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});

// Admin Routes (Protected by AdminMiddleware)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/booking/{id}/approve', [AdminController::class, 'approveBooking'])->name('admin.booking.approve');
    Route::post('/admin/booking/{id}/reject', [AdminController::class, 'rejectBooking'])->name('admin.booking.reject');
});
