<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CineBook</title>
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
                <a href="{{ route('admin.dashboard') }}" class="active">📊 Dashboard</a>
                <a href="{{ route('admin.reservations') }}">🎟️ Reservations</a>
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
            <h1 class="page-title">📊 Dashboard</h1>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistics Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-bottom: 40px;">
                <div class="movie-card" style="background: linear-gradient(135deg, #e50914 0%, #8b5cf6 100%); border: none;">
                    <div style="padding: 30px;">
                        <div style="font-size: 48px; margin-bottom: 15px;">🎟️</div>
                        
                        <div style="font-size: 16px; opacity: 0.9;">Total Bookings</div>
                    </div>
                </div>

                <div class="movie-card" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%); border: none;">
                    <div style="padding: 30px;">
                        <div style="font-size: 48px; margin-bottom: 15px;">💰</div>
                        
                        <div style="font-size: 16px; opacity: 0.9;">Total Revenue</div>
                    </div>
                </div>

                <div class="movie-card" style="background: linear-gradient(135deg, #f59e0b 0%, #ec4899 100%); border: none;">
                    <div style="padding: 30px;">
                        <div style="font-size: 48px; margin-bottom: 15px;">👥</div>
                        
                        <div style="font-size: 16px; opacity: 0.9;">Total Customers</div>
                    </div>
                </div>

                <div class="movie-card" style="background: linear-gradient(135deg, #8b5cf6 0%, #3b82f6 100%); border: none;">
                    <div style="padding: 30px;">
                        <div style="font-size: 48px; margin-bottom: 15px;">🎬</div>
                        
                        <div style="font-size: 16px; opacity: 0.9;">Active Movies</div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <h2 style="font-size: 28px; margin-bottom: 20px;">🎟️ Recent Bookings</h2>
            
            @if($recentBookings->count() > 0)
                <div style="background: rgba(20, 20, 30, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: rgba(229, 9, 20, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                                <th style="padding: 15px; text-align: left; font-weight: 600;">Booking ID</th>
                                <th style="padding: 15px; text-align: left;">Customer</th>
                                <th style="padding: 15px; text-align: left;">Movie</th>
                                <th style="padding: 15px; text-align: left;">Seats</th>
                                <th style="padding: 15px; text-align: left;">Total</th>
                                <th style="padding: 15px; text-align: left;">Date</th>
                                <th style="padding: 15px; text-align: left;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBookings as $booking)
                                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                                    <td style="padding: 15px; font-weight: 600; color: #e50914;">{{ $booking->booking_number }}</td>
                                    <td style="padding: 15px;">{{ $booking->customer_name }}</td>
                                    <td style="padding: 15px;">{{ $booking->movie->title }}</td>
                                    <td style="padding: 15px;">{{ $booking->number_of_seats }}</td>
                                    <td style="padding: 15px; color: #10b981; font-weight: 600;">${{ number_format($booking->total_price, 2) }}</td>
                                    <td style="padding: 15px;">{{ $booking->created_at->format('M d, Y') }}</td>
                                    <td style="padding: 15px;">
                                        <span style="padding: 5px 12px; background: rgba(16, 185, 129, 0.2); color: #10b981; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px; text-align: center;">
                    <a href="{{ route('admin.reservations') }}" class="action-btn primary">
                        View All Reservations →
                    </a>
                </div>
            @else
                <p style="color: rgba(255, 255, 255, 0.6); text-align: center; padding: 40px;">No bookings yet.</p>
            @endif
        </div>
    </main>

    <footer class="admin-footer">
        <p>&copy; {{ date('Y') }} CineBook Admin Panel. All rights reserved.</p>
    </footer>
</body>
</html>
