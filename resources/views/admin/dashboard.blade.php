@extends('layouts.admin')

@section('title', 'Admin Dashboard - MovieServe')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-gray-900 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <h1 class="text-2xl font-bold">Admin Dashboard - MovieServe</h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="text-gray-300">Admin Panel</span>
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

        <!-- Stats -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-600 text-sm mb-1 font-semibold">Pending Reservations</p>
                        <p class="text-3xl font-bold text-yellow-900">{{ $stats['pending'] }}</p>
                    </div>
                    <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-600 text-sm mb-1 font-semibold">Approved Reservations</p>
                        <p class="text-3xl font-bold text-green-900">{{ $stats['approved'] }}</p>
                    </div>
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-600 text-sm mb-1 font-semibold">Total Reservations</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $stats['total'] }}</p>
                    </div>
                    <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Bookings -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Pending Reservations ({{ $pendingBookings->count() }})</h3>

            @if($pendingBookings->isEmpty())
                <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500">No pending reservations</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($pendingBookings as $booking)
                        <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $booking->movie->title }}</h3>
                                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold bg-yellow-500 text-white">Pending</span>
                                    </div>
                                    
                                    <div class="space-y-2 text-sm">
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Customer:</span>
                                            <span class="text-gray-900 font-semibold">{{ $booking->user->name }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Email:</span>
                                            <span class="text-gray-900">{{ $booking->user->email }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Showtime:</span>
                                            <span class="text-gray-900 font-semibold">{{ $booking->showtime }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Seats:</span>
                                            <span class="text-gray-900 font-semibold">{{ implode(', ', $booking->seats) }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Total Price:</span>
                                            <span class="text-gray-900 font-semibold">₱{{ $booking->total_price }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Booked on:</span>
                                            <span class="text-gray-900">{{ $booking->created_at->format('M d, Y \a\t h:i A') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('admin.booking.approve', $booking->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg inline-flex items-center gap-2 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.booking.reject', $booking->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg inline-flex items-center gap-2 transition-colors" onclick="return confirm('Are you sure you want to reject this booking?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Approved Bookings -->
        <div>
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Approved Reservations ({{ $approvedBookings->count() }})</h3>

            @if($approvedBookings->isEmpty())
                <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-gray-500">No approved reservations yet</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($approvedBookings as $booking)
                        <div class="bg-green-50 rounded-lg shadow-lg p-6 border-l-4 border-green-500">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $booking->movie->title }}</h3>
                                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold bg-green-600 text-white">Approved</span>
                                    </div>
                                    
                                    <div class="space-y-2 text-sm">
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Customer:</span>
                                            <span class="text-gray-900 font-semibold">{{ $booking->user->name }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Email:</span>
                                            <span class="text-gray-900">{{ $booking->user->email }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Showtime:</span>
                                            <span class="text-gray-900 font-semibold">{{ $booking->showtime }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Seats:</span>
                                            <span class="text-gray-900 font-semibold">{{ implode(', ', $booking->seats) }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Total Price:</span>
                                            <span class="text-gray-900 font-semibold">${{ $booking->total_price }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-600">Booked on:</span>
                                            <span class="text-gray-900">{{ $booking->created_at->format('M d, Y \a\t h:i A') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
