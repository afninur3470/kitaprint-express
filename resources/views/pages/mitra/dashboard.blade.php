@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-dark tracking-tight">Dashboard Mitra</h1>
            <p class="text-secondary mt-1">{{ $store->name }}</p>
        </div>
        
        <!-- Status Toko -->
        <div class="bg-white border border-border p-2 rounded-xl shadow-sm flex items-center space-x-3 cursor-pointer">
            <div class="bg-primary text-white px-4 py-2 rounded-lg font-bold text-sm">Buka</div>
            <span class="text-secondary font-medium pr-3">Tutup</span>
        </div>
    </div>

    <!-- Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-card p-6 shadow-soft border border-border">
            <p class="text-secondary font-semibold mb-1">Pesanan Hari Ini</p>
            <h2 class="text-4xl font-extrabold text-dark">{{ $ordersToday }}</h2>
        </div>
        <div class="bg-accent rounded-card p-6 shadow-soft col-span-1 md:col-span-2 relative overflow-hidden">
            <div class="absolute -right-4 - bottom-4 text-8xl opacity-20">💰</div>
            <p class="text-dark/80 font-semibold mb-1">Pendapatan Hari Ini</p>
            <h2 class="text-4xl font-extrabold text-dark">Rp {{ number_format($revenueToday, 0, ',', '.') }}</h2>
        </div>
    </div>

    <!-- Pesanan Baru (Menunggu Dicetak) -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
            Pesanan Baru 
            @if($incomingOrders->count() > 0)
                <span class="ml-2 bg-danger text-white text-xs px-2 py-1 rounded-full">{{ $incomingOrders->count() }}</span>
            @endif
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($incomingOrders as $order)
            <div class="bg-white rounded-card border border-border p-5 shadow-soft border-l-4 border-l-primary">
                <div class="flex justify-between items-start mb-4 border-b border-border pb-4">
                    <div>
                        <h3 class="font-bold text-dark text-lg">{{ $order->document_name }}</h3>
                        <p class="text-sm text-secondary">Pemesan: {{ $order->user->name }}</p>
                        <div class="flex space-x-2 mt-2">
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $order->paper_size }}</span>
                            @if($order->is_binding) <span class="text-xs bg-gray-100 px-2 py-1 rounded">Jilid {{ $order->binding_color }}</span> @endif
                            @if($order->is_express) <span class="text-xs bg-accent font-bold px-2 py-1 rounded">Express</span> @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-secondary">Total Bayar</p>
                        <p class="text-lg font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                <form action="{{ route('mitra.order.update-status', $order->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="printing">
                    <button type="submit" class="w-full bg-primary text-white font-bold px-6 py-2.5 rounded-btn hover:bg-green-600 transition">
                        Mulai Cetak
                    </button>
                </form>
            </div>
            @empty
            <div class="col-span-2 text-center py-8 bg-white rounded-card border border-border">
                <p class="text-secondary">Belum ada pesanan baru saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Pesanan Sedang Diproses -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-dark mb-4">Sedang Dicetak / Siap Diambil</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($processingOrders as $order)
            <div class="bg-white rounded-card border border-border p-5 shadow-soft">
                <div class="flex justify-between items-start mb-4 border-b border-border pb-4">
                    <div>
                        <h3 class="font-bold text-dark text-lg">{{ $order->document_name }}</h3>
                        <span class="text-xs font-bold px-2 py-1 rounded-md mt-2 inline-block
                            {{ $order->status === 'printing' ? 'bg-warning/20 text-warning' : 'bg-primary/20 text-primary' }}">
                            {{ $order->status === 'printing' ? 'Sedang Dicetak' : 'Siap Diambil Kurir' }}
                        </span>
                    </div>
                    <p class="text-sm font-bold text-dark">#{{ $order->order_number }}</p>
                </div>

                @if($order->status === 'printing')
                <form action="{{ route('mitra.order.update-status', $order->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="ready">
                    <button type="submit" class="w-full bg-accent text-dark font-bold px-6 py-2.5 rounded-btn hover:bg-yellow-300 transition shadow-sm">
                        Tandai Selesai Produksi
                    </button>
                </form>
                @else
                <div class="bg-primary/10 text-primary text-center font-bold py-2.5 rounded-btn">
                    Menunggu Kurir Datang
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-2 text-center py-8 bg-white rounded-card border border-border">
                <p class="text-secondary">Tidak ada pesanan yang sedang diproses.</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection