@extends('layouts.app')

@section('title', 'MovieServe - Home')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-900 via-purple-800 to-indigo-900">
    <div class="container mx-auto px-4 py-16">
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-6">
                <svg class="w-16 h-16 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                </svg>
                <h1 class="text-6xl font-bold text-white">MovieServe</h1>
            </div>
            <p class="text-xl text-purple-200">Your Ultimate Movie Reservation Experience</p>
        </div>

        <!-- Hero Section -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-lg p-8">
                <h2 class="text-3xl font-bold text-white text-center mb-4">Welcome to MovieServe</h2>
                <p class="text-purple-100 text-center mb-8">
                    Book your favorite movies, select your perfect seat and showtime, and enjoy a seamless reservation experience.
                </p>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg p-8 shadow-2xl hover:shadow-3xl transition-shadow">
                        <svg class="w-12 h-12 text-purple-600 mb-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-center mb-4 text-gray-900">Login</h3>
                        <p class="text-gray-600 text-center mb-6">
                            Already have an account? Sign in to book your movies.
                        </p>
                        <a href="{{ route('login') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition-colors">
                            Login Now
                        </a>
                    </div>

                    <div class="bg-white rounded-lg p-8 shadow-2xl hover:shadow-3xl transition-shadow">
                        <svg class="w-12 h-12 text-indigo-600 mb-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-center mb-4 text-gray-900">Sign Up</h3>
                        <p class="text-gray-600 text-center mb-6">
                            New here? Create an account to get started.
                        </p>
                        <a href="{{ route('register') }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition-colors">
                            Sign Up Now
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="grid md:grid-cols-4 gap-8 max-w-6xl mx-auto">
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-lg p-6">
                <div class="text-4xl mb-4">🎬</div>
                <h3 class="text-xl font-semibold text-white mb-2">Latest Movies</h3>
                <p class="text-purple-200">Browse and book the latest blockbuster movies</p>
            </div>

            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-lg p-6">
                <div class="text-4xl mb-4">🕐</div>
                <h3 class="text-xl font-semibold text-white mb-2">Choose Showtime</h3>
                <p class="text-purple-200">Select your preferred time slot</p>
            </div>

            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-lg p-6">
                <div class="text-4xl mb-4">💺</div>
                <h3 class="text-xl font-semibold text-white mb-2">Pick Your Seat</h3>
                <p class="text-purple-200">Select your preferred seats with real-time availability</p>
            </div>

            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-lg p-6">
                <div class="text-4xl mb-4">✉️</div>
                <h3 class="text-xl font-semibold text-white mb-2">Get Confirmed</h3>
                <p class="text-purple-200">Receive email confirmations for your bookings</p>
            </div>
        </div>
    </div>
</div>
@endsection
