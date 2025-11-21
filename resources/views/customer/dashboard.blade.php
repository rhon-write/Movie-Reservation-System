@extends('layouts.app')

@section('title', 'Dashboard - MovieServe')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-purple-900 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                    <h1 class="text-2xl font-bold">MovieServe</h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="text-purple-200">Welcome, {{ Auth::user()->name }}!</span>
                    <a href="{{ route('customer.profile') }}" class="border border-white/20 text-white hover:bg-white/10 px-4 py-2 rounded-lg transition-colors">
                        My Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="border border-white/20 text-white hover:bg-white/10 px-4 py-2 rounded-lg transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Now Showing</h2>
            <p class="text-gray-600">Select a movie to book your tickets</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($movies as $movie)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow">
                    <div class="aspect-[2/3] bg-gray-200 relative overflow-hidden">
                        <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $movie->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $movie->description }}</p>
                        <div class="mb-4">
                            <span class="text-sm text-gray-500 block mb-1">Available Showtimes:</span>
                            <div class="flex flex-wrap gap-1">
                                @foreach($movie->showtimes as $showtime)
                                    <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">{{ $showtime }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-sm text-gray-500">
                                <span class="block">Price per seat</span>
                                <span class="text-gray-900 font-semibold text-lg">₱{{ $movie->price }}</span>
                            </div>
                        </div>
                        <a href="{{ route('movie.show', $movie->id) }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>
@endsection
