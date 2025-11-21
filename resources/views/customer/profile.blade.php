@extends('layouts.app')

@section('title', 'My Profile - MovieServe')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-purple-900 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('customer.dashboard') }}" class="text-white hover:bg-white/10 px-3 py-2 rounded">
                    ← Back to Dashboard
                </a>
                <h1 class="text-2xl font-bold">My Profile</h1>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- User Info -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <div class="flex items-center gap-6 mb-6">
                    <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->name }}</h2>
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $user->email }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <p class="text-purple-600 text-sm mb-1">Total Bookings</p>
                        <p class="text-2xl font-bold text-purple-900">{{ $bookings->count() }}</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <p class="text-yellow-600 text-sm mb-1">Pending</p>
                        <p class="text-2xl font-bold text-yellow-900">{{ $bookings->where('status', 'pending')->count() }}</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <p class="text-green-600 text-sm mb-1">Approved</p>
                        <p class="text-2xl font-bold text-green-900">{{ $bookings->where('status', 'approved')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Bookings -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">My Bookings</h3>

                @if($bookings->isEmpty())
                    <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                        <p class="text-gray-500 mb-2">No bookings yet</p>
                        <p class="text-gray-400 text-sm mb-4">Start by booking a movie from the dashboard</p>
                        <a href="{{ route('customer.dashboard') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                            Browse Movies
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($bookings as $booking)
                            <div class="bg-white rounded-lg shadow-lg p-6 
                                {{ $booking->status === 'approved' ? 'border-l-4 border-green-500' : '' }}
                                {{ $booking->status === 'pending' ? 'border-l-4 border-yellow-500' : '' }}">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-3">
                                            <h4 class="text-xl font-bold text-gray-900">{{ $booking->movie->title }}</h4>
                                            @if($booking->status === 'pending')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-500 text-white">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Pending Approval
                                                </span>
                                            @endif
                                            @if($booking->status === 'approved')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-600 text-white">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Approved
                                                </span>
                                            @endif
                                        </div>

                                        <div class="space-y-2 text-sm">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="text-gray-600">Showtime:</span>
                                                <span class="text-gray-900 font-semibold">{{ $booking->showtime }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span class="text-gray-600">Seats:</span>
                                                <span class="text-gray-900 font-semibold">{{ implode(', ', $booking->seats) }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="text-gray-600">Total Price:</span>
                                                <span class="text-gray-900 font-semibold">${{ $booking->total_price }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-gray-600">Booked on:</span>
                                                <span class="text-gray-900">{{ $booking->created_at->format('M d, Y \a\t h:i A') }}</span>
                                            </div>
                                        </div>

                                        @if($booking->status === 'pending')
                                            <div class="mt-4 bg-yellow-100 border border-yellow-300 p-3 rounded">
                                                <p class="text-yellow-800 text-sm">
                                                    ⏳ Your booking is waiting for admin approval. You'll receive an email once it's approved.
                                                </p>
                                            </div>
                                        @endif

                                        @if($booking->status === 'approved')
                                            <div class="mt-4 bg-green-100 border border-green-300 p-3 rounded">
                                                <p class="text-green-800 text-sm">
                                                    ✅ Your booking has been confirmed! Check your email for details.
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection
