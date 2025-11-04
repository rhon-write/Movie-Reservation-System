<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations - CineBook Admin</title>
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
</head>
<body>
    <header class="admin-header">
        <div class="header-container">
            <div class="header-left">
                <div class="logo">
                    <span class="logo-icon">🎬</span>
                    <span class="logo-text">CineBook Admin</span>
                </div>
            </div>

            <nav class="header-nav">
                <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('admin.reservations') }}" class="active">🎟️ Reservations</a>
            </nav>

            <div class="header-right">
                <div class="admin-profile">
                    <span class="admin-name">👨‍💼 {{ Auth::guard('admin')->user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">🚪 Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main class="admin-main">
        <div class="main-container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1 class="page-title">🎟️ All Reservations</h1>
                <a href="{{ route('admin.export.reservations') }}" class="action-btn primary">
                    📥 Export CSV
                </a>
            </div>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search and Filter -->
            <div style="background: rgba(20, 20, 30, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 20px; margin-bottom: 30px;">
                <form method="GET" action="{{ route('admin.reservations') }}" style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search by booking ID, customer name, email..." 
                        value="{{ request('search') }}"
                        style="flex: 1; min-width: 300px;"
                    >
                    <button type="submit" class="action-btn primary" style="width: auto; padding: 12px 30px;">
                        🔍 Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.reservations') }}" class="action-btn outline" style="width: auto; padding: 12px 20px;">
                            ✖ Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Reservations Table -->
            @if($bookings->count() > 0)
                <div style="background: rgba(20, 20, 30, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; overflow: hidden; margin-bottom: 30px;">
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
                            <thead>
                                <tr style="background: rgba(229, 9, 20, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                                    <th style="padding: 15px; text-align: left; font-weight: 600;">Booking ID</th>
                                    <th style="padding: 15px; text-align: left;">Customer</th>
                                    <th style="padding: 15px; text-align: left;">Contact</th>
                                    <th style="padding: 15px; text-align: left;">Movie</th>
                                    <th style="padding: 15px; text-align: left;">Show Date</th>
                                    <th style="padding: 15px; text-align: left;">Show Time</th>
                                    <th style="padding: 15px; text-align: left;">Seats</th>
                                    <th style="padding: 15px; text-align: left;">Seat Numbers</th>
                                    <th style="padding: 15px; text-align: left;">Total</th>
                                    <th style="padding: 15px; text-align: left;">Booked On</th>
                                    <th style="padding: 15px; text-align: left;">Status</th>
                                    <th style="padding: 15px; text-align: left;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                                        <td style="padding: 15px; font-weight: 600; color: #e50914;">{{ $booking->booking_number }}</td>
                                        <td style="padding: 15px;">{{ $booking->customer_name }}</td>
                                        <td style="padding: 15px;">
                                            <div style="font-size: 14px;">{{ $booking->customer_email }}</div>
                                            <div style="font-size: 12px; color: rgba(255, 255, 255, 0.6);">{{ $booking->customer_phone }}</div>
                                        </td>
                                        <td style="padding: 15px;">{{ $booking->movie->title }}</td>
                                        <td style="padding: 15px;">{{ \Carbon\Carbon::parse($booking->showTime->show_date)->format('M d, Y') }}</td>
                                        <td style="padding: 15px;">{{ date('h:i A', strtotime($booking->showTime->show_time)) }}</td>
                                        <td style="padding: 15px; text-align: center;">{{ $booking->number_of_seats }}</td>
                                        <td style="padding: 15px; font-size: 13px;">{{ $booking->seat_numbers }}</td>
                                        <td style="padding: 15px; color: #10b981; font-weight: 600;">${{ number_format($booking->total_price, 2) }}</td>
                                        <td style="padding: 15px; font-size: 13px;">{{ $booking->created_at->format('M d, Y H:i') }}</td>
                                        <td style="padding: 15px;">
                                            @if($booking->status === 'confirmed')
                                                <span style="padding: 5px 12px; background: rgba(16, 185, 129, 0.2); color: #10b981; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                                    ✓ Confirmed
                                                </span>
                                            @else
                                                <span style="padding: 5px 12px; background: rgba(239, 68, 68, 0.2); color: #ef4444; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                                    ✕ Cancelled
                                                </span>
                                            @endif
                                        </td>
                                        <td style="padding: 15px;">
                                            @if($booking->status === 'confirmed')
                                                <form action="{{ route('admin.reservations.cancel', $booking->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                    @csrf
                                                    <button type="submit" style="padding: 6px 12px; background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #ef4444; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @else
                                                <span style="color: rgba(255, 255, 255, 0.4); font-size: 12px;">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div style="display: flex; justify-content: center;">
                    {{ $bookings->links() }}
                </div>
            @else
                <div style="background: rgba(20, 20, 30, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 60px; text-align: center;">
                    <div style="font-size: 64px; margin-bottom: 20px; opacity: 0.3;">🎟️</div>
                    <h3 style="font-size: 24px; margin-bottom: 10px;">No Reservations Found</h3>
                    <p style="color: rgba(255, 255, 255, 0.6);">
                        @if(request('search'))
                            No bookings match your search criteria.
                        @else
                            No bookings have been made yet.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </main>

    <footer class="admin-footer">
        <p>&copy; {{ date('Y') }} CineBook Admin Panel. All rights reserved.</p>
    </footer>
</body>
</html>
