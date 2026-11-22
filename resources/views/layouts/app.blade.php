<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaPrint Express</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="web-app" x-data="{ sidebarOpen: false }">

    <!-- Overlay untuk Mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="sidebar-scrim" x-cloak></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" :class="sidebarOpen ? 'mobile-open' : ''">
        <div class="sidebar-brand">
            <div class="brand">
                <span class="brand-mark">🖨️</span>
                <span>KitaPrint <b>Express</b></span>
            </div>
            <button class="mobile-close" @click="sidebarOpen = false">✕</button>
        </div>

        <div class="role-badge">
            <span>👤</span> Role: 
            @if(auth()->user()->hasRole('admin')) Admin
            @elseif(auth()->user()->hasRole('mitra')) Mitra Toko
            @elseif(auth()->user()->hasRole('kurir')) Kurir
            @else Pengguna Umum @endif
        </div>

        <nav class="side-nav">
            <p class="nav-label">MENU UTAMA</p>
            @if(auth()->user()->hasRole('admin'))
                <button onclick="window.location.href='{{ route('admin.dashboard') }}'" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><span>📊</span> <span>Dashboard Admin</span></button>
            @elseif(auth()->user()->hasRole('mitra'))
                <button onclick="window.location.href='{{ route('mitra.dashboard') }}'" class="{{ request()->routeIs('mitra.dashboard') ? 'active' : '' }}"><span>🏪</span> <span>Dashboard Toko</span></button>
            @elseif(auth()->user()->hasRole('kurir'))
                <button onclick="window.location.href='{{ route('kurir.dashboard') }}'" class="{{ request()->routeIs('kurir.dashboard') ? 'active' : '' }}"><span>🛵</span> <span>Order Tersedia</span></button>
            @else
                <button onclick="window.location.href='{{ route('home') }}'" class="{{ request()->routeIs('home') ? 'active' : '' }}"><span>🏠</span> <span>Home & Explore</span></button>
                <button onclick="window.location.href='{{ route('store-registration.index') }}'" class="{{ request()->routeIs('store-registration.*') ? 'active' : '' }}"><span>🏢</span> <span>Daftar Usaha</span></button>
            @endif
        </nav>

        <div class="sidebar-user">
            <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}<i></i></div>
            <span><strong>{{ auth()->user()->name }}</strong><small>{{ auth()->user()->email }}</small></span>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" style="font-size: 14px; color: #ef4444;">🚪</button></form>
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="app-shell">
        <header class="topbar">
            <button class="menu-button" @click="sidebarOpen = true">☰</button>
            <div class="global-search"><span>🔍</span><input type="text" placeholder="Cari toko atau layanan..."></div>
            <div class="topbar-actions">
                <button class="icon-button notification"><span>🔔</span><i></i></button>
                <a href="{{ route('order.upload') }}" class="web-button primary" style="text-decoration: none;">Pesan Sekarang</a>
            </div>
        </header>
        
        <main class="content-shell">
            @yield('content')
        </main>
    </div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</body>
</html>