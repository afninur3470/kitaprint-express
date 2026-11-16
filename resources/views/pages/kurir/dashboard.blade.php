@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header & Status -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-dark tracking-tight">Halo, {{ auth()->user()->name }} 🛵</h1>
            <p class="text-secondary mt-1">Siap mengantar pesanan hari ini?</p>
        </div>
        
        <!-- Toggle Online / Offline -->
        <div class="bg-white border border-border p-2 rounded-xl shadow-sm flex items-center space-x-3 cursor-pointer">
            <div class="bg-primary text-white px-4 py-2 rounded-lg font-bold text-sm">Online</div>
            <span class="text-secondary font-medium pr-3">Offline</span>
        </div>
    </div>

    <!-- Ringkasan Pendapatan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-accent rounded-card p-6 shadow-soft col-span-1 md:col-span-2 flex items-center justify-between relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 text-8xl opacity-20">💰</div>
            <div class="relative z-10">
                <p class="text-dark/80 font-semibold mb-1">Pendapatan Hari Ini</p>
                <h2 class="text-4xl font-extrabold text-dark">Rp 85.000</h2>
                <p class="text-dark/70 text-sm mt-2">Dari 8 pengantaran sukses</p>
            </div>
            <button class="relative z-10 bg-dark text-white font-bold px-6 py-3 rounded-btn hover:bg-gray-800 transition">
                Tarik Saldo
            </button>
        </div>
        
        <div class="bg-white rounded-card p-6 shadow-soft border border-border flex flex-col justify-center items-center text-center">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-secondary font-medium">Total Pengantaran</p>
            <p class="text-3xl font-bold text-dark mt-1">142</p>
        </div>
    </div>

    <!-- Daftar Order Tersedia -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-dark mb-4">Order Tersedia ({{ $orders->count() }})</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($orders as $order)
            <div class="bg-white rounded-card border border-border p-5 shadow-soft">
                <div class="flex justify-between items-start mb-4 border-b border-border pb-4">
                    <div>
                        <h3 class="font-bold text-dark text-lg">{{ $order->document_name }}</h3>
                        <p class="text-sm text-secondary mt-1">Pemesan: {{ $order->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-secondary">Ongkir</p>
                        <p class="text-xl font-bold text-primary">Rp {{ number_format($order->shipping_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                <form action="{{ route('kurir.order.accept', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-primary text-white font-bold px-6 py-2.5 rounded-btn hover:bg-green-600 transition">
                        Terima Order
                    </button>
                </form>
            </div>
            @empty
            <div class="col-span-2 text-center py-10 bg-white rounded-card border border-border">
                <p class="text-secondary">Belum ada order masuk.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection