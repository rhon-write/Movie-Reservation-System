@extends('layouts.app')

@section('title', 'Login - MovieServe')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-900 via-purple-800 to-indigo-900 flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <a href="/" class="inline-flex items-center text-white hover:text-white/80 mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Home
        </a>

        <div class="bg-white rounded-lg shadow-2xl p-8">
            <div class="flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
            </div>
            
            <h2 class="text-3xl font-bold text-center mb-2 text-gray-900">Customer Login</h2>
            <p class="text-gray-600 text-center mb-8">Sign in to book your movies</p>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded mb-6">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="Enter your email"
                        required
                    >
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center space-y-2">
                <a href="{{ route('password.request') }}" class="block text-purple-600 hover:text-purple-700 text-sm">
                    Forgot Password?
                </a>
                
                <div class="text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-700">
                        Sign up here
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
