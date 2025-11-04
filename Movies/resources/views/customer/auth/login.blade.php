<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login - CineBook</title>
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="admin-icon" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);">🎬</div>
                <h1 class="login-title" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Customer Login</h1>
                <p class="login-subtitle">Login to book your favorite movies</p>
            </div>

            @if($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('customer.login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="your@email.com"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="login-btn" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);">
                    Login to CineBook
                </button>
            </form>

            <div class="back-home" style="margin-top: 20px;">
                <p style="color: rgba(255, 255, 255, 0.7); text-align: center;">
                    Don't have an account? 
                    <a href="{{ route('customer.register') }}" style="color: #10b981; font-weight: 600;">Sign up here</a>
                </p>
            </div>

            <div class="back-home">
                <a href="{{ route('home') }}">← Back to Movies</a>
            </div>

            <div class="credentials-info" style="background: rgba(229, 9, 20, 0.1); border-color: rgba(229, 9, 20, 0.3); margin-top: 15px;">
                <h4 style="color: #e50914;">🛡️ Admin Access</h4>
                <p>Are you an admin? <a href="{{ route('admin.login') }}" style="color: #e50914; font-weight: 600;">Login here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
