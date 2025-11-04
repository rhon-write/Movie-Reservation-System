<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - CineBook</title>
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
                @else
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('customer.login') }}" class="action-btn outline">Login</a>
                        <a href="{{ route('customer.register') }}" class="action-btn primary">Sign Up</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <main class="admin-main">
        <div class="main-container">
            <div class="movie-detail">
                <div class="movie-detail-image">
                    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
                </div>
                <div class="movie-detail-content">
                    <h1 class="movie-detail-title">{{ $movie->title }}</h1>
                    <div class="movie-meta" style="margin-bottom: 20px;">
                        <span>⭐ {{ $movie->rating }}</span>
                        <span>🕐 {{ $movie->duration }}</span>
                        <span>🎭 {{ $movie->genre }}</span>
                    </div>
                    <p class="movie-detail-description">{{ $movie->description }}</p>

                    <h2 style="margin-top: 40px; margin-bottom: 20px;">🎟️ Select Showtime</h2>
                    
                    @if($movie->showTimes->count() > 0)
                        <div class="showtimes-container">
                            @foreach($movie->showTimes->groupBy('show_date') as $date => $times)
                                <div class="showtime-date-group">
                                    <h3 class="showtime-date">{{ \Carbon\Carbon::parse($date)->format('l, M d, Y') }}</h3>
                                    <div class="showtime-buttons">
                                        @foreach($times as $showTime)
                                            <a href="{{ route('booking.selectSeats', [$movie->id, $showTime->id]) }}" class="showtime-btn">
                                                {{ date('h:i A', strtotime($showTime->show_time)) }}
                                                <span class="showtime-price">${{ number_format($showTime->price, 2) }}</span>
                                                <span class="showtime-seats">{{ $showTime->available_seats }} seats left</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: rgba(255, 255, 255, 0.6);">No showtimes available at the moment.</p>
                    @endif
                </div>
            </div>

            <div style="margin-top: 30px;">
                <a href="{{ route('movies.index') }}" class="action-btn outline">← Back to Movies</a>
            </div>
        </div>
    </main>
</body>
</html>
