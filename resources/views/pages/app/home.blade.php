@extends('layouts.app')

@section('content')
<!-- Memuat CSS Peta (Leaflet) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="mb-6">
    <span class="text-xs font-bold text-secondary block mb-1">HOME & EXPLORE</span>
    <h1 class="text-3xl font-bold text-dark tracking-tight">Halo, {{ auth()->user()->name }} 👋</h1>
    <p class="text-secondary mt-1">Mau cetak apa hari ini?</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <!-- Promo Hero -->
        <div class="bg-accent rounded-2xl p-6 shadow-soft relative overflow-hidden">
            <div class="absolute -right-4 -top-4 text-7xl opacity-20">⚡</div>
            <div class="relative z-10">
                <span class="text-xs font-bold text-[#667030] block mb-2">⚡ EXPRESS PRINT</span>
                <h3 class="font-extrabold text-dark text-2xl leading-tight mb-2">Selesai 15–20 Menit.</h3>
                <p class="text-dark/80 text-sm mb-4">Bebas antre! Pesanan Anda akan didahulukan oleh mitra terdekat.</p>
                <a href="{{ route('order.upload') }}" class="inline-block bg-primary text-white font-bold px-6 py-2.5 rounded-btn text-sm shadow-md hover:bg-green-600 transition">Coba Sekarang →</a>
            </div>
        </div>

        <!-- Layanan -->
        <div>
            <h2 class="text-lg font-bold text-dark mb-4">Layanan Cetak</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl border border-border p-4 shadow-soft hover:shadow-md transition cursor-pointer">
                    <span class="text-2xl block mb-2">📄</span>
                    <strong class="text-sm block text-dark">Print Hitam Putih</strong>
                    <small class="text-secondary text-xs">± 5 menit</small>
                    <p class="text-primary font-bold text-sm mt-2">Rp 500</p>
                </div>
                <div class="bg-white rounded-xl border border-border p-4 shadow-soft hover:shadow-md transition cursor-pointer">
                    <span class="text-2xl block mb-2">🌈</span>
                    <strong class="text-sm block text-dark">Print Warna</strong>
                    <small class="text-secondary text-xs">± 10 menit</small>
                    <p class="text-primary font-bold text-sm mt-2">Rp 1.500</p>
                </div>
                <div class="bg-white rounded-xl border border-border p-4 shadow-soft hover:shadow-md transition cursor-pointer">
                    <span class="text-2xl block mb-2">📚</span>
                    <strong class="text-sm block text-dark">Jilid Hardcover</strong>
                    <small class="text-secondary text-xs">± 15 menit</small>
                    <p class="text-primary font-bold text-sm mt-2">Rp 25.000</p>
                </div>
                <div class="bg-white rounded-xl border border-border p-4 shadow-soft hover:shadow-md transition cursor-pointer">
                    <span class="text-2xl block mb-2">✨</span>
                    <strong class="text-sm block text-dark">Laminasi A3</strong>
                    <small class="text-secondary text-xs">± 8 menit</small>
                    <p class="text-primary font-bold text-sm mt-2">Rp 8.000</p>
                </div>
            </div>
        </div>

        <!-- MAP: Menggunakan Leaflet (Peta Asli) -->
        <div>
            <h2 class="text-lg font-bold text-dark mb-4">Toko di Sekitar</h2>
            
            <!-- CSS Khusus Peta -->
            <style>
                #map { height: 300px; width: 100%; border-radius: 12px; z-index: 1; }
                /* Mencegah Tailwind merusak gambar peta */
                .leaflet-container img { max-width: none !important; }
                /* Memaksa card berada di atas peta agar bisa diklik */
                .map-overlay-card { z-index: 1000 !important; pointer-events: auto; }
            </style>

            <div class="rounded-xl border border-border relative shadow-soft">
                <!-- Div Peta -->
                <div id="map"></div>
                
                <!-- Card Melayang di atas Peta -->
                <div class="absolute bottom-4 left-4 right-4 bg-white p-4 rounded-xl shadow-lg border border-border flex justify-between items-center map-overlay-card">
                    <div>
                        <p class="text-sm font-bold text-dark">3 toko di sekitar Anda</p>
                        <p class="text-xs text-secondary">Jarak rata-rata 500 m</p>
                    </div>
                    <!-- Tombol Perluas -->
                    <button onclick="perluasPeta()" class="text-primary text-sm font-bold hover:underline cursor-pointer bg-transparent border-0" style="z-index: 1001;">
                        Perluas
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Kanan -->
    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-border p-5 shadow-soft">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <span class="text-xl">📄</span>
                    <div>
                        <h3 class="font-bold text-dark text-sm">Pesanan Aktif</h3>
                        <p class="text-xs text-secondary">#KP-2026-1028-001</p>
                    </div>
                </div>
                <span class="bg-accent text-dark text-xs font-bold px-2 py-1 rounded-lg">⚡ Express</span>
            </div>
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">🏪</div>
                <div>
                    <strong class="text-sm block text-dark">Fotocopy Berkah Jaya</strong>
                    <small class="text-secondary text-xs">Laporan PKL.pdf • 68 hlm</small>
                </div>
            </div>
            <a href="{{ route('order.tracking') }}" class="block w-full border-2 border-primary text-primary font-bold py-2.5 rounded-btn text-sm text-center hover:bg-primary hover:text-white transition">Lacak Pesanan →</a>
        </div>

        <div class="bg-white rounded-xl border border-border p-5 shadow-soft">
            <div class="flex items-center space-x-3 mb-4">
                <span class="text-2xl">📤</span>
                <div>
                    <h3 class="font-bold text-dark text-sm">Cetak Ulang Cepat</h3>
                    <p class="text-secondary text-xs">Unggah file baru</p>
                </div>
            </div>
            <a href="{{ route('order.upload') }}" class="block w-full bg-accent text-dark font-bold py-2.5 rounded-btn text-sm text-center hover:bg-yellow-400 transition">Upload Dokumen</a>
        </div>
    </div>
</div>

<!-- Panggil Leaflet JS di paling bawah -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var map; // Variabel global

    window.onload = function() {
        // 1. SET VIEW KE KOTA PEKANBARU
        map = L.map('map').setView([0.5071, 101.4478], 14);

        // 2. LOAD GAMBAR PETA
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // 3. DESAIN PIN
        var customPin = L.divIcon({
            className: 'bg-transparent',
            html: '<div style="background: #10b981; width: 34px; height: 34px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.3);"><span style="transform: rotate(45deg); font-size: 16px;">🖨️</span></div>',
            iconSize: [34, 34],
            iconAnchor: [17, 34],
            popupAnchor: [0, -34]
        });

        // 4. PASANG PIN DI PEKANBARU
        L.marker([0.5071, 101.4478], { icon: customPin }).addTo(map).bindPopup('<b>Fotocopy Berkah Jaya</b><br>Buka');
        L.marker([0.5350, 101.4580], { icon: customPin }).addTo(map).bindPopup('<b>Print Center Unilak</b><br>Buka');
    };

    // 5. FUNGSI UNTUK TOMBOL PERLUAS
    function perluasPeta() {
        if (map) {
            // Zoom in dengan animasi flyTo
            map.flyTo([0.5071, 101.4478], 17, {
                animate: true,
                duration: 1.5 
            });
        }
    }
</script>
@endsection