<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed - CineBook</title>
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
</head>
<body>
    <header class="customer-header">
        <div class="header-container">
            <div class="header-left">
                <div class="logo">
                    <span class="logo-icon">🎬</span>
                    <span class="logo-text">CineBook</span>
                </div>
            </div>

            <nav class="header-nav">
                <a href="{{ route('movies.index') }}">🎥 Movies</a>
            </nav>

            <div class="header-right">
                @auth('web')
                    <div class="admin-profile">
                        <span class="admin-name">👋 {{ Auth::user()->name }}</span>
                        <form action="{{ route('customer.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn">🚪 Logout</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <main class="admin-main">
        <div class="main-container" style="max-width: 800px;">
            <div style="text-align: center; margin-bottom: 40px;">
                <div style="width: 120px; height: 120px; margin: 0 auto 30px; background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 60px; box-shadow: 0 0 40px rgba(16, 185, 129, 0.4);">
                    ✅
                </div>
                <h1 class="page-title" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Booking Confirmed!</h1>
                <p style="color: rgba(255, 255, 255, 0.7); font-size: 18px;">Your tickets have been reserved successfully</p>
            </div>

            <div style="background: rgba(20, 20, 30, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 40px; margin-bottom: 30px;">
                <div style="text-align: center; padding-bottom: 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 30px;">
                    <p style="color: rgba(255, 255, 255, 0.6); font-size: 14px; margin-bottom: 8px;">Booking ID</p>
                    <h2 style="font-size: 32px; font-weight: 700; color: #10b981;">{{ $booking->booking_number }}</h2>
                </div>

                <div style="margin-bottom: 25px;">
                    <h3 style="font-size: 20px; margin-bottom: 20px;">Movie Details</h3>
                    <div style="display: grid; gap: 15px;">
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <span style="color: rgba(255, 255, 255, 0.6);">Movie</span>
                            <span style="font-weight: 600;">{{ $booking->movie->title }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <span style="color: rgba(255, 255, 255, 0.6);">Date</span>
                            <span>{{ \Carbon\Carbon::parse($booking->showTime->show_date)->format('F d, Y') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <span style="color: rgba(255, 255, 255, 0.6);">Time</span>
                            <span>{{ date('h:i A', strtotime($booking->showTime->show_time)) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <span style="color: rgba(255, 255, 255, 0.6);">Seats</span>
                            <span style="font-weight: 600;">{{ $booking->seat_numbers }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <span style="color: rgba(255, 255, 255, 0.6);">Number of Seats</span>
                            <span>{{ $booking->number_of_seats }}</span>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 25px;">
                    <h3 style="font-size: 20px; margin-bottom: 20px;">Customer Information</h3>
                    <div style="display: grid; gap: 15px;">
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <span style="color: rgba(255, 255, 255, 0.6);">Name</span>
                            <span>{{ $booking->customer_name }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <span style="color: rgba(255, 255, 255, 0.6);">Email</span>
                            <span>{{ $booking->customer_email }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <span style="color: rgba(255, 255, 255, 0.6);">Phone</span>
                            <span>{{ $booking->customer_phone }}</span>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 30px; padding-top: 25px; border-top: 2px solid rgba(16, 185, 129, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 24px; font-weight: 700;">Total Paid</span>
                        <span style="font-size: 32px; font-weight: 700; color: #10b981;">${{ number_format($booking->total_price, 2) }}</span>
                    </div>
                </div>
            </div>

            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px; padding: 20px; margin-bottom: 30px;">
                <p style="color: #10b981; font-weight: 600; margin-bottom: 10px;">📧 Confirmation Email Sent!</p>
                <p style="color: rgba(255, 255, 255, 0.7); font-size: 14px;">
                    A confirmation email has been sent to <strong>{{ $booking->customer_email }}</strong>.
                    Please show your Booking ID at the cinema entrance.
                </p>
            </div>

            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="{{ route('movies.index') }}" class="action-btn primary" style="padding: 14px 30px;">
                    🎬 Browse More Movies
                </a>
                <a href="{{ route('home') }}" class="action-btn outline" style="padding: 14px 30px;">
                    🏠 Go Home
                </a>
            </div>
        </div>
    </main>

    <footer class="admin-footer">
        <p>&copy; {{ date('Y') }} CineBook. All rights reserved.</p>
    </footer>
</body>
</html>
