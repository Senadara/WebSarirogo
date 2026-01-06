@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-1 via-white to-accent-1 px-4 py-8 sm:px-6 lg:px-8">

    {{-- Login Card --}}
    <div class="w-full max-w-md">

        {{-- Logo & Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-primary-3 rounded-2xl shadow-lg mb-4">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-text-5">Smart Farm Sarirogo</h1>
            <p class="text-text-3 mt-2 text-sm sm:text-base">Masuk ke dashboard manajemen peternakan</p>
        </div>

        {{-- Card Form --}}
        <div class="bg-white rounded-2xl shadow-xl border border-bg-3 p-6 sm:p-8">
            
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="p-4 rounded-xl bg-green-50 border border-green-200">
                        <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-text-4 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-text-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            placeholder="nama@email.com"
                            class="w-full pl-10 pr-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-bg-4' }} rounded-xl text-text-5 placeholder-text-2
                                   focus:outline-none focus:ring-2 focus:ring-primary-3 focus:border-transparent
                                   transition duration-200 text-sm sm:text-base"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-text-4 mb-2">
                        Password
                    </label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-text-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            id="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full pl-10 pr-12 py-3 border {{ $errors->has('password') ? 'border-red-500' : 'border-bg-4' }} rounded-xl text-text-5 placeholder-text-2 focus:outline-none focus:ring-2 focus:ring-primary-3 focus:border-transparent transition duration-200 text-sm sm:text-base"
                        >
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition cursor-pointer"
                        >
                            {{-- Eye Open (show password) --}}
                            <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{-- Eye Closed (hide password) --}}
                            <svg x-cloak x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-bg-4 text-primary-3 focus:ring-primary-3 focus:ring-offset-0">
                        <span class="ml-2 text-sm text-text-3">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary-4 hover:text-primary-5 font-medium transition">
                        Lupa password?
                    </a>
                </div>

                {{-- Submit Button --}}
                <button 
                    type="submit"
                    style="background-color: #2E7D32;"
                    class="w-full py-3 px-4 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-xl
                           shadow-lg hover:shadow-xl
                           transform hover:-translate-y-0.5 transition-all duration-200
                           focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2
                           text-sm sm:text-base"
                >
                    Masuk
                </button>
            </form>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-bg-3"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-text-2">atau</span>
                </div>
            </div>

            {{-- Alternative Login --}}
            <button 
                type="button"
                class="w-full py-3 px-4 bg-white border-2 border-bg-4 hover:border-text-2 text-text-4 font-medium rounded-xl
                       flex items-center justify-center gap-3
                       hover:bg-bg-2 transition-all duration-200
                       text-sm sm:text-base"
            >
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Masuk dengan Google
            </button>
        </div>

        {{-- Footer Link --}}
        <p class="text-center mt-6 text-text-3 text-sm">
            Belum punya akun? 
            <a href="#" class="text-primary-4 hover:text-primary-5 font-semibold transition">
                Hubungi Admin
            </a>
        </p>

        {{-- Back to Home --}}
        <div class="text-center mt-4">
            <a href="{{ route('landing.index') }}" class="inline-flex items-center gap-2 text-text-2 hover:text-text-4 text-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
