@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-1 via-white to-accent-1 px-4 py-8 sm:px-6 lg:px-8">

    {{-- Card --}}
    <div class="w-full max-w-md">

        {{-- Logo & Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-primary-3 rounded-2xl shadow-lg mb-4">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-text-5">Lupa Password</h1>
            <p class="text-text-3 mt-2 text-sm sm:text-base">Masukkan email untuk reset password</p>
        </div>

        {{-- Card Form --}}
        <div class="bg-white rounded-2xl shadow-xl border border-bg-3 p-6 sm:p-8">

            <form action="{{ route('password.verify') }}" method="POST" class="space-y-5">
                @csrf

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
                            class="w-full pl-10 pr-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-bg-4' }} rounded-xl text-text-5 placeholder-text-2 focus:outline-none focus:ring-2 focus:ring-primary-3 focus:border-transparent transition duration-200 text-sm sm:text-base"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    style="background-color: #2E7D32;"
                    class="w-full py-3 px-4 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-sm sm:text-base"
                >
                    Lanjutkan
                </button>
            </form>
        </div>

        {{-- Back to Login --}}
        <div class="text-center mt-6">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-text-2 hover:text-text-4 text-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Login
            </a>
        </div>
    </div>
</div>
@endsection
