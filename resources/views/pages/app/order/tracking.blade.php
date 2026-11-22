@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold">Pesanan #{{ $order->order_number }}</h1>
        <p class="text-[var(--muted)] mt-2">Status saat ini: <span class="font-bold text-[var(--green-dark)] uppercase">{{ $order->status }}</span></p>
    </div>

    <!-- Progress Bar Dinamis -->
    <div class="white-card p-6">
        <div class="flex justify-between relative z-10">
            <!-- Garis Background -->
            <div class="absolute top-5 left-0 w-full h-1 bg-gray-200 -z-10"></div>
            
            @php
                $steps = ['pending' => 'Diterima', 'printing' => 'Dicetak', 'ready' => 'Siap', 'delivering' => 'Diantar', 'completed' => 'Selesai'];
                $currentIndex = array_search($order->status, array_keys($steps));
            @endphp

            @foreach($steps as $key => $label)
                @php $isCompleted = array_search($key, array_keys($steps)) <= $currentIndex; @endphp
                <div class="flex flex-col items-center bg-white px-2">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold {{ $isCompleted ? 'bg-[var(--green)] text-white' : 'bg-gray-200 text-gray-400' }}">
                        {{ $isCompleted ? '✓' : '' }}
                    </div>
                    <span class="text-xs font-bold mt-2 {{ $isCompleted ? 'text-[var(--ink)]' : 'text-[var(--muted)]' }}">{{ $label }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card Dokumen -->
        <div class="white-card p-6">
            <h3 class="font-bold mb-4 border-b pb-2">Detail Cetak</h3>
            <div class="flex items-center gap-3">
                <span class="text-3xl">📄</span>
                <div>
                    <strong class="block">{{ $order->document_name }}</strong>
                    <small class="text-[var(--muted)]">{{ $order->total_pages }} Halaman • {{ $order->paper_size }}</small>
                </div>
            </div>
            @if($order->is_express)
                <div class="mt-4 bg-[var(--lime)] text-[#334000] text-xs font-bold p-2 rounded-lg inline-block">⚡ Layanan Express</div>
            @endif
        </div>

        <!-- Card Kurir / QR Code -->
        <div class="white-card p-6">
            @if($order->delivery_type === 'self_pick')
                <h3 class="font-bold mb-4 border-b pb-2">Ambil Mandiri (QR)</h3>
                <div class="text-center bg-gray-50 p-4 rounded-xl border border-dashed">
                    <div class="text-5xl mb-2">🔲</div>
                    <p class="text-xs text-[var(--muted)]">Tunjukkan QR ini ke kasir.</p>
                </div>
            @else
                <h3 class="font-bold mb-4 border-b pb-2">Informasi Kurir</h3>
                @if($order->courier)
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-xl">🛵</div>
                        <div>
                            <strong class="block">{{ $order->courier->name }}</strong>
                            <small class="text-[var(--green-dark)] font-bold">Sedang Menuju Lokasi</small>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-[var(--muted)]">Menunggu kurir mengambil pesanan...</p>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection