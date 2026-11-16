<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaPrint Express</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-dark antialiased h-screen overflow-hidden flex">

    <!-- Notifikasi Global -->
    @if(session('success'))
        <div id="toast-success" class="fixed top-5 right-5 bg-primary text-white px-6 py-3 rounded-xl shadow-lg z-[999] flex items-center space-x-2 animate-bounce">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
        <script>setTimeout(() => document.getElementById('toast-success').remove(), 3000);</script>
    @endif

    @if(session('error'))
        <div id="toast-error" class="fixed top-5 right-5 bg-danger text-white px-6 py-3 rounded-xl shadow-lg z-[999] flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            <span class="font-bold">{{ session('error') }}</span>
        </div>
        <script>setTimeout(() => document.getElementById('toast-error').remove(), 3000);</script>
    @endif

    <!-- LEFT SIDEBAR (Desktop) -->
    <aside class="hidden md:flex flex-col w-[240px] bg-white border-r border-border h-full flex-shrink-0 z-20">
        <!-- Logo -->
        <div class="h-20 flex items-center px-6 border-b border-border">
            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white mr-3">
                🖨️
            </div>
            <span class="text-xl font-bold text-dark tracking-tight">KitaPrint</span>
        </div>

        <!-- Menu Navigasi -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            @if(auth()->user()->hasRole('kurir'))
                <!-- MENU KURIR -->
                <a href="{{ route('kurir.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('kurir.dashboard') ? 'bg-primary/10 text-primary font-bold' : 'text-secondary hover:bg-gray-50 hover:text-dark font-medium transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Order Tersedia</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-secondary hover:bg-gray-50 hover:text-dark font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <span>Pengantaran Aktif</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-secondary hover:bg-gray-50 hover:text-dark font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <span>Dompet Saya</span>
                </a>
            @elseif(auth()->user()->hasRole('mitra'))
                <!-- MENU MITRA -->
                <a href="{{ route('mitra.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('mitra.dashboard') ? 'bg-primary/10 text-primary font-bold' : 'text-secondary hover:bg-gray-50 hover:text-dark font-medium transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Dashboard Toko</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-secondary hover:bg-gray-50 hover:text-dark font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    <span>Katalog & Harga</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-secondary hover:bg-gray-50 hover:text-dark font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Laporan Pendapatan</span>
                </a>
            @else
                <!-- MENU PENGGUNA UMUM -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('home') ? 'bg-primary/10 text-primary font-bold' : 'text-secondary hover:bg-gray-50 hover:text-dark font-medium transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Home & Explore</span>
                </a>
                <a href="{{ route('store-registration.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('store-registration.*') ? 'bg-primary/10 text-primary font-bold' : 'text-secondary hover:bg-gray-50 hover:text-dark font-medium transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span>Daftar Usaha</span>
                </a>
            @endif
        </nav>

        <!-- Profil Bawah -->
        <div class="p-4 border-t border-border">
            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 mb-4 p-2 rounded-xl hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-primary/20 text-primary rounded-full flex items-center justify-center font-bold text-lg">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-dark">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-xs text-secondary">Pengaturan Profil</p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-sm text-danger font-semibold hover:text-red-700 transition flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- AREA KANAN (Header + Content) -->
    <div class="flex-1 flex flex-col h-full relative overflow-hidden">
        
        <!-- HEADER MOBILE (Hanya muncul di HP) -->
        <header class="md:hidden h-16 bg-white border-b border-border flex items-center justify-between px-4 sticky top-0 z-30 flex-shrink-0">
            <div class="flex items-center">
                <span class="text-xl font-bold text-primary">KitaPrint</span>
            </div>
            <button class="text-secondary">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </header>

        <!-- TOP HEADER DESKTOP -->
        <header class="hidden md:flex h-20 bg-white border-b border-border items-center justify-between px-8 sticky top-0 z-10 flex-shrink-0">
            <!-- Search Bar di Header -->
            <div class="flex items-center bg-gray-50 rounded-xl px-4 py-2 w-96 border border-border">
                <svg class="w-5 h-5 text-secondary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Cari toko atau layanan..." class="bg-transparent border-none focus:ring-0 text-sm w-full outline-none text-dark placeholder-secondary">
            </div>

            <!-- Kanan: Notifikasi -->
            <div class="flex items-center space-x-4">
                <button class="relative p-2 text-secondary hover:text-primary transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-2 right-2 block h-2 w-2 rounded-full bg-danger ring-2 ring-white"></span>
                </button>
            </div>
        </header>

        <!-- KONTEN UTAMA (Scrollable) -->
        <main class="flex-1 overflow-y-auto p-4 md:p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>