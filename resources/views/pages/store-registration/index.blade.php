@extends('layouts.mobile')

@section('content')
<div class="px-6 pt-4 pb-4 flex items-center bg-white sticky top-0 z-40 border-b border-border">
    <a href="{{ route('home') }}" class="mr-4 text-dark">←</a>
    <h1 class="text-lg font-bold text-dark">Daftarkan Usahamu</h1>
</div>

<div class="p-6">
    <div class="bg-white rounded-card border border-border p-8 text-center shadow-soft mt-4">
        @if ($store && $store->isPending())
            <div class="text-5xl mb-4">⏳</div>
            <h3 class="text-xl font-bold text-dark mb-2">Sedang Diverifikasi</h3>
            <p class="text-secondary text-sm mb-6">Verifikasi maksimal 24 jam.</p>
            <a href="{{ route('store-registration.status') }}" class="block w-full bg-primary text-white font-bold py-3 rounded-btn shadow-soft">Lihat Status</a>
        @elseif ($store && $store->isRejected())
            <div class="text-5xl mb-4">❌</div>
            <h3 class="text-xl font-bold text-danger mb-2">Pendaftaran Ditolak</h3>
            <div class="bg-red-50 text-red-700 text-xs p-3 rounded-lg mb-6 text-left">{{ $store->rejection_reason }}</div>
            <a href="#" class="block w-full bg-primary text-white font-bold py-3 rounded-btn shadow-soft">Daftar Ulang</a>
        @else
            <div class="w-24 h-24 bg-accent rounded-full flex items-center justify-center mx-auto mb-6 text-5xl">🏪</div>
            <h3 class="text-2xl font-bold text-dark mb-2">Jadi Mitra</h3>
            <p class="text-secondary text-sm mb-8">Daftarkan percetakan Anda dan jangkau mahasiswa.</p>
            <a href="{{ route('store-registration.create') }}" class="block w-full bg-primary text-white font-bold py-3 rounded-btn shadow-soft">Daftar Sekarang</a>
        @endif
    </div>
</div>
@endsection