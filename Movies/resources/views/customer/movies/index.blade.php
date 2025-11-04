<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Movies - CineBook</title>
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
                <a href="{{ route('movies.index') }}" class="active">🎥 Movies</a>
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
                        <a href="{{ route('customer.login') }}" class="action-btn outline" style="padding: 10px 24px;">Login</a>
                        <a href="{{ route('customer.register') }}" class="action-btn primary" style="padding: 10px 24px;">Sign Up</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <main class="admin-main">
        <div class="main-container">
            <h1 class="page-title">🎬 Now Showing</h1>

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
        <p>&copy; {{ date('Y') }} CineBook. All rights reserved.</p>
    </footer>
</body>
</html>
