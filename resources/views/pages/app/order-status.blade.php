@extends('layouts.mobile')

@section('content')
<div class="px-6 pt-4 pb-4 flex items-center bg-white sticky top-0 z-40 border-b border-border">
    <a href="{{ route('home') }}" class="mr-4 text-dark">←</a>
    <h1 class="text-lg font-bold text-dark">Status Pesanan</h1>
</div>

<div class="p-6">
    <!-- Simulasi Data Pesanan -->
    @php
        $order = (object)[
            'id' => 'KP-2026-1028-001',
            'delivery_type' => 'self_pick', // Ubah ke 'scheduled_courier' untuk tes tampilan besok pagi
            'pickup_code' => 'KTP-XYZ-789',
            'status' => 'Sedang Dicetak'
        ];
    @endphp

    <div class="bg-white p-6 rounded-card border border-border shadow-soft text-center">
        <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl">🖨️</span>
        </div>
        <h2 class="text-xl font-bold text-dark mb-1">{{ $order->status }}</h2>
        <p class="text-sm text-secondary mb-6">Pesanan #{{ $order->id }}</p>

        <!-- Tampilan SELF PICK -->
        @if($order->delivery_type == 'self_pick')
            <div class="bg-gray-50 border border-border p-6 rounded-xl mb-4">
                <p class="text-sm font-semibold text-dark mb-2">Tunjukkan QR ini ke kasir:</p>
                <div class="w-32 h-32 bg-white border-2 border-dashed border-gray-300 mx-auto flex items-center justify-center mb-3">
                    <span class="text-4xl text-gray-400">QR</span>
                </div>
                <p class="text-lg font-mono font-bold tracking-widest text-primary">{{ $order->pickup_code }}</p>
                <p class="text-xs text-secondary mt-2">Toko buka 24 jam. Ambil pesanan Anda kapan saja.</p>
            </div>
        
        <!-- Tampilan SCHEDULED DELIVERY -->
        @elseif($order->delivery_type == 'scheduled_courier')
            <div class="bg-accent/20 border border-warning/30 p-4 rounded-xl mb-4 text-left">
                <p class="text-sm font-bold text-dark flex items-center"><span class="mr-2">🌅</span> Jadwal Pengantaran</p>
                <p class="text-xs text-secondary mt-1">Pesanan akan diantar oleh kurir pada kloter pertama besok pagi (07:00 - 09:00 WIB).</p>
            </div>

        <!-- Tampilan KURIR REGULER -->
        @else
            <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl mb-4 text-left">
                <p class="text-sm font-bold text-blue-800 flex items-center"><span class="mr-2">🛵</span> Kurir Sedang Menuju Lokasi</p>
                <p class="text-xs text-blue-600 mt-1">Estimasi tiba dalam 15-20 menit.</p>
            </div>
        @endif

        <button class="w-full border-2 border-primary text-primary font-bold py-3 rounded-btn mt-2">
            Hubungi Toko
        </button>
    </div>
</div>
@endsection