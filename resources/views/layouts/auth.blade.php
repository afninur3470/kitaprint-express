<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaPrint Express</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] font-sans text-dark antialiased h-screen flex items-center justify-center p-4 sm:p-6">

    <!-- Container Utama: Berbentuk Card di Tengah Layar -->
    <div class="w-full max-w-[1000px] bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row h-auto md:h-[650px]">
        
        <!-- Sisi Kiri: Ilustrasi (Hanya muncul di Desktop) -->
        <div class="hidden md:flex md:w-1/2 bg-primary relative p-12 flex-col justify-between overflow-hidden">
            <!-- Ornamen Lingkaran Halus -->
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-black/10 rounded-full"></div>
            
            <div class="relative z-10">
                <div class="flex items-center space-x-2 text-white mb-10">
                    <span class="text-3xl">🖨️</span>
                    <span class="text-2xl font-bold tracking-tight">KitaPrint</span>
                </div>
                <h1 class="text-3xl font-bold text-white mb-4 leading-tight">Cetak Dokumen Lebih Mudah & Cepat.</h1>
                <p class="text-white/80">Tanpa antre. Pesanan Anda diantar langsung sampai tujuan oleh kurir mahasiswa.</p>
            </div>
            
            <div class="relative z-10 text-white/60 text-sm">
                &copy; 2026 KitaPrint Express.
            </div>
        </div>

        <!-- Sisi Kanan: Area Form -->
        <div class="w-full md:w-1/2 flex flex-col h-full relative">
            <!-- Tombol Navigasi Kanan Atas (Register/Login) -->
            <div class="absolute top-6 right-8 text-sm text-secondary z-20">
                @yield('top-right-link')
            </div>

            <!-- Scrollable Form Content -->
            <div class="flex-1 overflow-y-auto p-8 sm:p-12 flex flex-col justify-center">
                @yield('content')
            </div>
        </div>
        
    </div>

</body>
</html>