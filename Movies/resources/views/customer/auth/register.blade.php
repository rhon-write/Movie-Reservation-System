<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - CineBook</title>
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="admin-icon" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);">✨</div>
                <h1 class="login-title" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Create Account</h1>
                <p class="login-subtitle">Join CineBook to start booking movies</p>
            </div>

            @if($errors->any())
                <div class="error-message">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="John Doe"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="your@email.com"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone') }}"
                        placeholder="+1234567890"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Minimum 6 characters"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Re-enter password"
                        required
                    >
                </div>

                <button type="submit" class="login-btn" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);">
                    Create Account
                </button>
            </form>

            <div class="back-home" style="margin-top: 20px;">
                <p style="color: rgba(255, 255, 255, 0.7); text-align: center;">
                    Already have an account? 
                    <a href="{{ route('customer.login') }}" style="color: #10b981; font-weight: 600;">Login here</a>
                </p>
            </div>

            <div class="back-home">
                <a href="{{ route('home') }}">← Back to Movies</a>
            </div>
        </div>
    </div>
</body>
</html>
