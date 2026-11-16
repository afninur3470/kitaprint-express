@extends('layouts.app')

@section('content')
<!-- Grid 12 Kolom -->
<div class="grid grid-cols-12 gap-8 max-w-7xl mx-auto">
    
    <!-- KOLOM KIRI (8 dari 12) -->
    <div class="col-span-12 lg:col-span-8 space-y-6">
        
        <!-- Sapaan -->
        <div>
            <h1 class="text-3xl font-bold text-dark tracking-tight">Halo, {{ auth()->user()->name }} 👋</h1>
            <p class="text-secondary mt-1">Mau cetak apa hari ini?</p>
        </div>

        <!-- Filter Pills -->
        <div class="flex space-x-2 overflow-x-auto pb-2 scrollbar-hide">
            <button class="whitespace-nowrap px-4 py-2 rounded-xl bg-primary text-white text-sm font-medium shadow-sm">Semua</button>
            <button class="whitespace-nowrap px-4 py-2 rounded-xl bg-white border border-border text-secondary text-sm font-medium hover:bg-gray-50">Cetak Warna</button>
            <button class="whitespace-nowrap px-4 py-2 rounded-xl bg-white border border-border text-secondary text-sm font-medium hover:bg-gray-50">Jilid Skripsi</button>
            <button class="whitespace-nowrap px-4 py-2 rounded-xl bg-white border border-border text-secondary text-sm font-medium hover:bg-gray-50">Rating Tinggi</button>
        </div>

        <!-- Daftar Toko -->
        <div class="space-y-4">
            <!-- Card Toko 1 -->
            <div class="bg-white rounded-card border border-border p-4 shadow-soft hover:shadow-md transition flex gap-5">
                <!-- Foto Toko -->
                <div class="w-40 h-32 bg-gray-200 rounded-xl flex-shrink-0 relative overflow-hidden">
                    <div class="absolute top-2 left-2 bg-primary text-white text-[11px] font-bold px-2 py-1 rounded-md">Buka</div>
                </div>
                <!-- Info Toko -->
                <div class="flex-1 py-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-dark text-xl">Fotocopy Berkah Jaya</h3>
                        <div class="flex items-center space-x-2 mt-2">
                            <span class="text-sm font-bold text-warning bg-warning/10 px-2 py-0.5 rounded">★ 4.9</span>
                            <span class="text-sm text-secondary">(128 ulasan)</span>
                            <span class="text-sm text-secondary">• 200 m dari lokasi</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="text-xs bg-gray-100 text-secondary px-2 py-1 rounded-md border border-gray-200">Jilid Hardcover</span>
                            <span class="text-xs bg-gray-100 text-secondary px-2 py-1 rounded-md border border-gray-200">Cetak A3</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-end mt-4">
                        <span class="text-sm text-secondary">Mulai dari <strong class="text-dark text-base">Rp 500</strong>/lbr</span>
                        <a href="#" class="border-2 border-primary text-primary font-bold px-5 py-2 rounded-btn text-sm hover:bg-primary hover:text-white transition">Lihat Toko</a>
                    </div>
                </div>
            </div>

            <!-- Card Toko 2 -->
            <div class="bg-white rounded-card border border-border p-4 shadow-soft hover:shadow-md transition flex gap-5">
                <div class="w-40 h-32 bg-gray-200 rounded-xl flex-shrink-0 relative overflow-hidden"></div>
                <div class="flex-1 py-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-dark text-xl">Print Center Unilak</h3>
                        <div class="flex items-center space-x-2 mt-2">
                            <span class="text-sm font-bold text-warning bg-warning/10 px-2 py-0.5 rounded">★ 4.7</span>
                            <span class="text-sm text-secondary">(85 ulasan)</span>
                            <span class="text-sm text-secondary">• 1,2 km dari lokasi</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-end mt-4">
                        <span class="text-sm text-secondary">Mulai dari <strong class="text-dark text-base">Rp 500</strong>/lbr</span>
                        <a href="#" class="border-2 border-primary text-primary font-bold px-5 py-2 rounded-btn text-sm hover:bg-primary hover:text-white transition">Lihat Toko</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KOLOM KANAN (4 dari 12) -->
    <div class="col-span-12 lg:col-span-4 space-y-6">
        
        <!-- Banner Promo Express -->
        <div class="bg-accent rounded-card p-6 shadow-soft relative overflow-hidden">
            <div class="absolute -right-4 -top-4 text-7xl opacity-20">⚡</div>
            <div class="relative z-10">
                <h3 class="font-extrabold text-dark text-2xl leading-tight mb-2">Express Print</h3>
                <p class="text-dark/80 text-sm mb-4">Selesai 15–20 Menit. Prioritas utama tanpa antre.</p>
                <button class="bg-primary text-white font-bold px-6 py-2.5 rounded-btn text-sm shadow-md hover:bg-green-600 transition">Coba Sekarang</button>
            </div>
        </div>

        <!-- Peta Interaktif (Mockup) -->
        <div class="bg-white rounded-card border border-border p-2 shadow-soft h-[400px] relative">
            <div class="w-full h-full bg-blue-50 rounded-xl overflow-hidden relative flex items-center justify-center">
                <p class="text-secondary text-sm font-medium">🗺️ Peta Interaktif (Maps API)</p>
                
                <!-- Floating Card Info Peta -->
                <div class="absolute bottom-4 left-4 right-4 bg-white p-4 rounded-xl shadow-lg border border-border flex justify-between items-center">
                    <div>
                        <p class="text-sm font-bold text-dark">3 toko di sekitar Anda</p>
                        <p class="text-xs text-secondary">Jarak rata-rata 500 m</p>
                    </div>
                    <button class="text-primary text-sm font-bold">Perluas</button>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection