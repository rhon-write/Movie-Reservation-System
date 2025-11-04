<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineBook - Movie Reservations</title>
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
                <a href="{{ route('home') }}" class="active">🎥 Movies</a>
            </nav>

            <div class="header-right">
                @auth('web')
                    <div class="admin-profile">
                        <span class="admin-name">👋 {{ Auth::user()->name }}</span>
                        <form action="{{ route('customer.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn" style="background: rgba(16, 185, 129, 0.2); border-color: rgba(16, 185, 129, 0.3); color: #10b981;">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('customer.login') }}" class="action-btn outline" style="padding: 10px 24px;">
                            Login
                        </a>
                        <a href="{{ route('customer.register') }}" class="action-btn primary" style="padding: 10px 24px; background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);">
                            Sign Up
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <main class="admin-main">
        <div class="main-container">
            @if(session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif

            <div class="hero-section">
                <h1 class="hero-title">🎬 Welcome to CineBook</h1>
                <p class="subtitle">Book your favorite movies online</p>
                
                @guest('web')
                    <div style="display: flex; gap: 20px; justify-content: center; margin-top: 40px;">
                        <a href="{{ route('customer.login') }}" class="action-btn outline" style="padding: 16px 40px; font-size: 18px;">
                            Login
                        </a>
                        <a href="{{ route('customer.register') }}" class="action-btn primary" style="padding: 16px 40px; font-size: 18px; background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);">
                            Sign Up
                        </a>
                    </div>
                @endguest
            </div>

            <div class="movies-grid">
                @foreach($movies as $movie)
                <div class="movie-card">
                    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="movie-image">
                    <div class="movie-content">
                        <h3 class="movie-title">{{ $movie->title }}</h3>
                        <div class="movie-meta">
                            <span>⭐ {{ $movie->rating }}</span>
                            <span>🕐 {{ $movie->duration }}</span>
                        </div>
                        <div class="movie-meta">
                            <span>🎭 {{ $movie->genre }}</span>
                        </div>
                        <p class="movie-description">{{ Str::limit($movie->description, 120) }}</p>
                        <a href="{{ route('movies.show', $movie->id) }}" class="movie-btn">Book Now</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    <footer class="admin-footer">
        <p>&copy; {{ date('Y') }} CineBook. All rights reserved. | <a href="{{ route('admin.login') }}" style="color: #e50914;">Admin Login</a></p>
    </footer>
</body>
</html>
