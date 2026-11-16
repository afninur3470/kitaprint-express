@extends('layouts.auth')

@section('top-right-link')
    Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Masuk</a>
@endsection

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-dark mb-2">Buat Akun</h1>
    <p class="text-secondary">Bergabunglah dengan ribuan mahasiswa lainnya.</p>
</div>

@if ($errors->any())
    <div class="mb-6 p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-danger">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf
    
    <div>
        <label class="block text-sm font-semibold text-dark mb-1">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus
               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" 
               placeholder="Nama Anda">
    </div>

    <div>
        <label class="block text-sm font-semibold text-dark mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" 
               placeholder="nama@email.com">
    </div>

    <div>
        <label class="block text-sm font-semibold text-dark mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" 
               placeholder="Minimal 8 karakter">
    </div>

    <div>
        <label class="block text-sm font-semibold text-dark mb-1">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required
               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" 
               placeholder="Ulangi password">
    </div>

    <button type="submit" class="w-full bg-primary text-white font-bold py-3.5 rounded-xl shadow-md hover:bg-green-600 transition-all active:scale-[0.98] mt-6">
        Daftar Sekarang
    </button>
</form>
@endsection