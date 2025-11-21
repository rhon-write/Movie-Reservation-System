@extends('layouts.admin')

@section('title', 'Admin Login - MovieServe')

@section('content')
<div class="min-h-screen bg-black/90 flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="bg-gray-900 border border-red-900 rounded-lg shadow-2xl p-8">
            <div class="flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            
            <h2 class="text-3xl font-bold text-center mb-2 text-white">Admin Access</h2>
            <p class="text-gray-400 text-center mb-8">Authorized Personnel Only</p>

            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-700 text-red-200 px-4 py-3 rounded mb-6">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-white mb-2">Admin Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        placeholder="admin@moviereservation.com"
                        required
                    >
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-white mb-2">Admin Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        placeholder="Enter admin password"
                        required
                    >
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors mb-3">
                    Admin Login
                </button>

                <a href="/" class="block w-full text-center border border-gray-700 text-gray-300 hover:bg-gray-800 font-semibold py-3 px-6 rounded-lg transition-colors">
                    Cancel
                </a>
            </form>

            <div class="mt-6 p-3 bg-yellow-900/30 border border-yellow-700 rounded">
                <p class="text-yellow-200 text-sm text-center">
                    ⚠️ Default: admin@moviereservation.com / admin123
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
