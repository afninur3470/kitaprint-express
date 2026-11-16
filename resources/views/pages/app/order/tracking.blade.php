@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-dark tracking-tight">Pesanan #{{ $order->order_number }}</h1>
            <p class="text-secondary mt-1">Status: <span class="font-bold text-primary">{{ strtoupper($order->status) }}</span></p>
        </div>
        @if($order->is_express)
        <div class="bg-accent text-dark font-bold px-4 py-2 rounded-lg text-sm">⚡ Express</div>
        @endif
    </div>

    <!-- Progress Tracker -->
    <div class="bg-white p-8 rounded-card border border-border shadow-soft">
        <div class="flex justify-between relative">
            <!-- Garis Penghubung -->
            <div class="absolute top-5 left-0 w-full h-1 bg-gray-200 -z-10"></div>
            <div class="absolute top-5 left-0 w-2/4 h-1 bg-primary -z-10"></div>

            <!-- Step 1 -->
            <div class="flex flex-col items-center bg-white px-2">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white mb-2">✓</div>
                <span class="text-sm font-bold text-dark">Pembayaran</span>
            </div>
            <!-- Step 2 -->
            <div class="flex flex-col items-center bg-white px-2">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white mb-2 animate-pulse">🖨️</div>
                <span class="text-sm font-bold text-primary">Sedang Dicetak</span>
            </div>
            <!-- Step 3 -->
            <div class="flex flex-col items-center bg-white px-2">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 mb-2">🛵</div>
                <span class="text-sm font-medium text-secondary">Diantar</span>
            </div>
            <!-- Step 4 -->
            <div class="flex flex-col items-center bg-white px-2">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 mb-2">🏁</div>
                <span class="text-sm font-medium text-secondary">Selesai</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Detail Kurir (Disimulasikan sudah di-assign) -->
        <div class="bg-white p-6 rounded-card border border-border shadow-soft">
            <h3 class="font-bold text-dark mb-4 border-b border-border pb-2">Informasi Kurir</h3>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 bg-gray-200 rounded-full flex items-center justify-center text-xl">👨‍🎓</div>
                    <div>
                        <h4 class="font-bold text-dark">Budi Santoso</h4>
                        <p class="text-xs text-secondary">Kurir Mahasiswa • Fasilkom</p>
                        <p class="text-sm font-bold text-warning mt-1">★ 4.8</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition">💬</button>
                    <button class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition">📞</button>
                </div>
            </div>
        </div>

        <!-- Status Splitbill -->
        <div class="bg-accent/20 p-6 rounded-card border border-primary/30">
            <h3 class="font-bold text-dark mb-4 border-b border-primary/20 pb-2">Status Patungan (Splitbill)</h3>
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm text-dark font-medium">2/3 Lunas</span>
                <span class="bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">Rp 18.000 Terkumpul</span>
            </div>
            <div class="flex -space-x-2 mb-4">
                <div class="w-8 h-8 rounded-full bg-green-500 border-2 border-white flex items-center justify-center text-white text-xs font-bold z-30">R</div>
                <div class="w-8 h-8 rounded-full bg-green-500 border-2 border-white flex items-center justify-center text-white text-xs font-bold z-20">B</div>
                <div class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white flex items-center justify-center text-gray-600 text-xs font-bold z-10">S</div>
            </div>
            <button class="text-primary text-xs font-bold underline">Ingatkan Sari untuk bayar</button>
        </div>
    </div>
</div>
@endsection