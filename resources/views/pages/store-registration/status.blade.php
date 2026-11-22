@extends('layouts.mobile')

@section('content')
<div class="px-6 pt-4 pb-4 flex items-center bg-white sticky top-0 z-40 border-b border-border">
    <a href="{{ route('home') }}" class="mr-4 text-dark">←</a>
    <h1 class="text-lg font-bold text-dark">Status Verifikasi</h1>
</div>

<div class="p-6">
    <div class="bg-white rounded-card border border-border shadow-soft overflow-hidden">
        <div class="p-8 text-center border-b border-border">
            @if ($store->isPending())
                <div class="text-5xl mb-4 animate-pulse">⏳</div>
                <h3 class="text-xl font-bold text-warning mb-2">Verifikasi 1x24 Jam</h3>
                <p class="text-sm text-secondary">Pengajuan Anda sedang ditinjau oleh Admin.</p>
            @elseif ($store->isApproved())
                <div class="text-5xl mb-4">🎉</div>
                <h3 class="text-xl font-bold text-primary mb-2">Terverifikasi!</h3>
                <p class="text-sm text-secondary mb-6">Akun Anda kini menjadi Mitra Toko.</p>
                <a href="#" class="block w-full bg-primary text-white font-bold py-3 rounded-btn shadow-soft">Ke Dashboard Mitra</a>
            @elseif ($store->isRejected())
                <div class="text-5xl mb-4">❌</div>
                <h3 class="text-xl font-bold text-danger mb-2">Pendaftaran Ditolak</h3>
                <div class="bg-red-50 text-left p-4 rounded-lg mb-6 border border-red-100 text-sm text-red-700">
                    <strong>Catatan:</strong><br> {{ $store->rejection_reason }}
                </div>
            @endif
        </div>
        <div class="p-6 bg-gray-50 space-y-3 text-sm">
            <div class="flex justify-between"><span class="text-secondary">Nama Usaha</span><span class="font-semibold text-dark">{{ $store->name }}</span></div>
            <div class="flex justify-between"><span class="text-secondary">Jenis</span><span class="font-semibold text-dark">{{ ucwords(str_replace('_', ' ', $store->business_type)) }}</span></div>
        </div>
    </div>
</div>
@endsection