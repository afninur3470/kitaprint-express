@extends('layouts.mobile')

@section('content')
<!-- Panggil Service di Controller untuk mengirim data ini, sementara kita mockup dulu di view -->
@php
    // Simulasi pengecekan (Di produksi asli, logika ini ada di Controller)
    $isCourierAvailable = app(\App\Services\DeliveryService::class)->isCourierAvailable();
    $deliveryOptions = app(\App\Services\DeliveryService::class)->getAvailableDeliveryOptions();
@endphp

<div class="px-6 pt-4 pb-4 flex items-center bg-white sticky top-0 z-40 border-b border-border">
    <a href="{{ route('home') }}" class="mr-4 text-dark">←</a>
    <h1 class="text-lg font-bold text-dark">Checkout</h1>
</div>

<div class="p-6 space-y-6">
    
    <!-- Peringatan Mode Malam -->
    @if(!$isCourierAvailable)
    <div class="bg-accent/20 border border-warning/30 p-4 rounded-xl flex items-start space-x-3">
        <span class="text-2xl">🌙</span>
        <div>
            <h4 class="text-sm font-bold text-dark">Layanan Kurir Sedang Offline</h4>
            <p class="text-xs text-secondary mt-1">Kurir mahasiswa beristirahat. Pesanan Anda bisa diambil mandiri atau diantar besok pagi.</p>
        </div>
    </div>
    @endif

    <!-- Pilihan Pengiriman -->
    <div class="bg-white p-5 rounded-card border border-border shadow-soft">
        <h3 class="font-bold text-dark border-b border-border pb-2 mb-4">Metode Pengiriman</h3>
        
        <div class="space-y-3">
            @foreach($deliveryOptions as $key => $option)
            <label class="flex items-center justify-between p-4 border {{ $loop->first ? 'border-primary bg-primary/5' : 'border-border' }} rounded-xl cursor-pointer">
                <div class="flex items-center space-x-3">
                    <input type="radio" name="delivery_type" value="{{ $key }}" {{ $loop->first ? 'checked' : '' }} class="text-primary focus:ring-primary">
                    <div>
                        <p class="font-bold text-dark text-sm">{{ $option['label'] }}</p>
                        <p class="text-xs text-secondary">{{ $option['desc'] }}</p>
                    </div>
                </div>
                <span class="text-sm font-bold {{ $option['cost'] == 0 ? 'text-primary' : 'text-dark' }}">
                    {{ $option['cost'] == 0 ? 'Gratis' : 'Rp ' . number_format($option['cost'], 0, ',', '.') }}
                </span>
            </label>
            @endforeach
        </div>
    </div>

    <form action="{{ route('order.process') }}" method="POST">
        @csrf
        <button type="submit" class="w-full bg-primary text-white font-bold py-3.5 rounded-btn shadow-md hover:bg-green-600 transition">
            Bayar & Pesan
        </button>
    </form>
</div>
@endsection