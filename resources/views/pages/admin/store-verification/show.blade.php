@extends('layouts.mobile')

@section('content')
<div class="px-6 pt-4 pb-4 flex items-center bg-white sticky top-0 z-40 border-b border-border">
    <a href="{{ route('admin.store-verification.index') }}" class="mr-4 text-dark">←</a>
    <h1 class="text-lg font-bold text-dark">Review Pengajuan</h1>
</div>

<div class="p-6 space-y-4">
    <!-- Data Toko -->
    <div class="bg-white p-5 rounded-card border border-border shadow-soft">
        <h3 class="font-bold text-dark border-b border-border pb-2 mb-3">Data Usaha</h3>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between"><span class="text-secondary">Nama</span><span class="font-semibold">{{ $store->name }}</span></div>
            <div class="flex justify-between"><span class="text-secondary">Jenis</span><span class="font-semibold">{{ ucwords(str_replace('_', ' ', $store->business_type)) }}</span></div>
            <div class="flex justify-between"><span class="text-secondary">Pemilik</span><span class="font-semibold">{{ $store->owner->name }}</span></div>
            <div class="flex justify-between"><span class="text-secondary">Telepon</span><span class="font-semibold">{{ $store->phone }}</span></div>
            <div class="pt-2">
                <span class="text-secondary block mb-1">Alamat:</span>
                <p class="text-sm font-medium text-dark bg-gray-50 p-2 rounded">{{ $store->address }}, {{ $store->city }}</p>
            </div>
        </div>
    </div>

    <!-- Dokumen -->
    <div class="bg-white p-5 rounded-card border border-border shadow-soft">
        <h3 class="font-bold text-dark border-b border-border pb-2 mb-3">Dokumen & Rekening</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between items-center">
                <span class="text-secondary">KTP: {{ $store->ktp_number }}</span>
                <a href="{{ Storage::url($store->ktp_photo) }}" target="_blank" class="text-xs text-primary font-bold underline">Lihat Foto</a>
            </div>
            <div class="flex justify-between items-center border-t border-border pt-2">
                <span class="text-secondary">Bank</span><span class="font-semibold">{{ $store->bank_name }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-secondary">No. Rek</span><span class="font-semibold">{{ $store->bank_account_number }}</span>
            </div>
        </div>
    </div>

    <!-- Aksi Admin -->
    @if ($store->isPending())
        <div class="space-y-3 mt-6 mb-8">
            <form action="{{ route('admin.store-verification.approve', $store) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" onclick="return confirm('Setujui pengajuan ini?')" class="w-full bg-primary text-white font-bold py-3.5 rounded-btn shadow-soft">
                    ✓ Setujui & Jadikan Mitra
                </button>
            </form>

            <div x-data="{ open: false }">
                <button @click="open = !open" type="button" class="w-full border-2 border-danger text-danger font-bold py-3 rounded-btn">
                    ✗ Tolak Pengajuan
                </button>
                <div x-show="open" x-cloak class="mt-3 bg-white p-4 rounded-card border border-red-200">
                    <form action="{{ route('admin.store-verification.reject', $store) }}" method="POST">
                        @csrf @method('PATCH')
                        <textarea name="rejection_reason" rows="3" required placeholder="Alasan penolakan (min 10 karakter)..." class="w-full bg-gray-50 border border-border rounded-btn text-sm mb-2"></textarea>
                        <button type="submit" class="w-full bg-danger text-white font-bold py-2 rounded-btn text-sm">Kirim Penolakan</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection