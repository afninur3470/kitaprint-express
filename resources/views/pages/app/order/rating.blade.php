@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto" x-data="{ rating: 0, problem: false }">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-dark tracking-tight">Konfirmasi Pesanan</h1>
        <p class="text-secondary mt-1">Apakah pesanan sudah Anda terima dengan baik?</p>
    </div>

    <div class="bg-white rounded-card border border-border shadow-soft p-8">
        
        <!-- Pilihan Konfirmasi -->
        <div class="flex justify-center space-x-4 mb-8">
            <button @click="problem = false" :class="!problem ? 'border-primary bg-primary/5 text-primary' : 'border-gray-200 text-secondary'" class="border-2 px-8 py-3 rounded-xl font-bold flex items-center space-x-2 transition">
                <span>✅</span> <span>Ya, Sudah Diterima</span>
            </button>
            <button @click="problem = true" :class="problem ? 'border-danger bg-red-50 text-danger' : 'border-gray-200 text-secondary'" class="border-2 px-8 py-3 rounded-xl font-bold flex items-center space-x-2 transition">
                <span>⚠️</span> <span>Ada Masalah</span>
            </button>
        </div>

        <!-- Form Masalah (Jika ada masalah) -->
        <div x-show="problem" x-transition class="mb-8 bg-red-50 p-4 rounded-xl border border-red-200">
            <label class="block text-sm font-bold text-red-800 mb-2">Jelaskan Masalah (Akan diteruskan ke Admin)</label>
            <textarea rows="3" class="w-full bg-white border border-red-200 rounded-lg text-sm focus:ring-danger" placeholder="Contoh: Hasil cetak buram / jilid lepas..."></textarea>
        </div>

        <!-- Form Rating (Jika sudah diterima) -->
        <div x-show="!problem" x-transition>
            <div class="text-center mb-8">
                <h3 class="text-lg font-bold text-dark mb-4">Beri Rating untuk Fotocopy Berkah Jaya</h3>
                <div class="flex justify-center space-x-2 text-4xl cursor-pointer">
                    <template x-for="i in 5">
                        <span @click="rating = i" :class="rating >= i ? 'text-warning' : 'text-gray-300'" class="transition hover:scale-110">★</span>
                    </template>
                </div>
                <p class="text-sm text-secondary mt-2" x-text="rating === 0 ? 'Pilih bintang' : (rating <= 2 ? 'Kurang Memuaskan' : (rating === 3 ? 'Cukup' : 'Sangat Baik!'))"></p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-dark mb-2">Bagikan pengalaman Anda (Opsional)</label>
                <textarea rows="3" class="w-full bg-gray-50 border border-border rounded-xl text-sm focus:ring-primary" placeholder="Cetakan sangat rapi dan cepat..."></textarea>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-semibold text-dark mb-2">Tag Cepat</label>
                <div class="flex flex-wrap gap-2">
                    <button class="text-xs bg-gray-100 border border-gray-200 text-secondary px-3 py-1.5 rounded-lg hover:border-primary hover:text-primary">Cepat</button>
                    <button class="text-xs bg-gray-100 border border-gray-200 text-secondary px-3 py-1.5 rounded-lg hover:border-primary hover:text-primary">Rapi</button>
                    <button class="text-xs bg-gray-100 border border-gray-200 text-secondary px-3 py-1.5 rounded-lg hover:border-primary hover:text-primary">Ramah</button>
                    <button class="text-xs bg-gray-100 border border-gray-200 text-secondary px-3 py-1.5 rounded-lg hover:border-primary hover:text-primary">Sesuai Pesanan</button>
                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <button class="w-full bg-primary text-white font-bold py-3.5 rounded-btn shadow-md hover:bg-green-600 transition">
            Kirim Ulasan & Selesaikan
        </button>
        <div class="text-center mt-4">
            <a href="#" class="text-sm text-secondary hover:underline">Nanti Saja</a>
        </div>
    </div>
</div>
@endsection