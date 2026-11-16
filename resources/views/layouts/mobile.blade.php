<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaPrint Express</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-dark antialiased flex h-screen overflow-hidden">

    <!-- SIDEBAR (Desktop) -->
    <aside class="hidden md:flex flex-col w-64 bg-white border-r border-border h-full">
        <div class="h-20 flex items-center px-6 border-b border-border">
            <span class="text-2xl mr-2">🖨️</span>
            <span class="text-xl font-bold text-primary">KitaPrint</span>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('home') ? 'bg-primary/10 text-primary font-bold' : 'text-secondary hover:bg-gray-50' }}">
                <span class="text-xl">🏠</span> <span>Home</span>
            </a>
            <a href="{{ route('store-registration.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('store-registration.*') ? 'bg-primary/10 text-primary font-bold' : 'text-secondary hover:bg-gray-50' }}">
                <span class="text-xl">🏪</span> <span>Toko Saya</span>
            </a>
        </nav>
        <div class="p-4 border-t border-border">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-primary">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-dark">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-xs text-secondary">{{ auth()->user()->getRoleNames()->first() ?? 'Pengguna' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-sm text-danger font-semibold hover:underline">Keluar Akun</button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col h-full relative">
        <!-- HEADER MOBILE -->
        <header class="md:hidden h-16 bg-white border-b border-border flex items-center justify-between px-4 sticky top-0 z-40">
            <span class="text-lg font-bold text-primary">KitaPrint</span>
            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center font-bold text-primary text-xs">
                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
            </div>
        </header>

        <!-- KONTEN (Scrollable) -->
        <main class="flex-1 overflow-y-auto pb-24 md:pb-0">
            @yield('content')
        </main>
    </div>

    <!-- BOTTOM NAV (Mobile Only) -->
    <nav class="md:hidden fixed bottom-0 w-full bg-white border-t border-border pb-safe pt-2 px-6 flex justify-between items-center z-50 shadow-[0_-4px_20px_rgba(0,0,0,0.05)]">
        <a href="{{ route('home') }}" class="flex flex-col items-center {{ request()->routeIs('home') ? 'text-primary' : 'text-secondary' }}">
            <span class="text-2xl">🏠</span>
            <span class="text-[10px] font-medium mt-1">Home</span>
        </a>
        <a href="{{ route('store-registration.index') }}" class="flex flex-col items-center {{ request()->routeIs('store-registration.*') ? 'text-primary' : 'text-secondary' }}">
            <span class="text-2xl">🏪</span>
            <span class="text-[10px] font-medium mt-1">Toko Saya</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="flex flex-col items-center text-secondary">
            @csrf
            <button type="submit" class="flex flex-col items-center">
                <span class="text-2xl">🚪</span>
                <span class="text-[10px] font-medium mt-1">Keluar</span>
            </button>
        </form>
    </nav>

</body>
</html>