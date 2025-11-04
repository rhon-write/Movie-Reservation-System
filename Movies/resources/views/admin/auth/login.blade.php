<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - CineBook</title>
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="admin-icon">🔐</div>
                <h1 class="login-title">Admin Login</h1>
                <p class="login-subtitle">Access CineBook Dashboard</p>
            </div>

            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Admin Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="admin@cinebook.com"
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

                <button type="submit" class="login-btn">
                    Login to Dashboard
                </button>
            </form>

            <div class="credentials-info">
                <h4>🔑 Default Admin Credentials:</h4>
                <p>Email: <code>admin@cinebook.com</code></p>
                <p>Password: <code>admin123</code></p>
            </div>

            <div class="back-home">
                <a href="{{ route('home') }}">← Back to Customer Site</a>
            </div>
        </div>
    </div>
</body>
</html>
