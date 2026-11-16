@extends('layouts.auth')

@section('top-right-link')
    Belum punya akun? <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Daftar</a>
@endsection

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-dark mb-2">Selamat Datang!</h1>
    <p class="text-secondary">Silakan masuk untuk melanjutkan ke akun Anda.</p>
</div>

@if ($errors->any())
    <div class="mb-6 p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-danger">
        Email atau password yang Anda masukkan salah.
    </div>
@endif

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf
    
    <div>
        <label class="block text-sm font-semibold text-dark mb-2">Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" 
               placeholder="Masukkan email Anda">
    </div>

    <div>
        <label class="block text-sm font-semibold text-dark mb-2">Password</label>
        <input type="password" name="password" required
               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" 
               placeholder="••••••••">
    </div>

    <div class="flex items-center justify-between pt-1">
        <label class="flex items-center space-x-2 cursor-pointer">
            <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary w-4 h-4">
            <span class="text-sm text-secondary">Ingat saya</span>
        </label>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-primary font-semibold hover:underline">Lupa Password?</a>
        @endif
    </div>

    <button type="submit" class="w-full bg-primary text-white font-bold py-3.5 rounded-xl shadow-md hover:bg-green-600 transition-all active:scale-[0.98] mt-4">
        Masuk
    </button>
</form>
@endsection