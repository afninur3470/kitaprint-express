@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div><span>ADMIN DASHBOARD</span><h1>Verifikasi Mitra</h1><p>Tinjau dan setujui pengajuan toko baru.</p></div>
</div>

<div class="history-table">
    <div class="table-head" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 16px; padding: 14px; background: #f8faf9; font-weight: bold; font-size: 12px; border-bottom: 1px solid var(--border);">
        <span>Nama Toko & Pemilik</span>
        <span>Status</span>
        <span>Aksi</span>
    </div>
    
    @forelse($stores as $store)
    <div class="table-row" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 16px; padding: 14px; border-bottom: 1px solid var(--border); align-items: center;">
        
        <!-- Info Toko -->
        <div>
            <strong style="display: block; font-size: 14px;">{{ $store->name }}</strong>
            <small style="color: var(--muted); font-size: 11px;">Pemilik: {{ $store->owner->name }}</small>
        </div>

        <!-- Status -->
        <div>
            <span class="complete-label" style="background: {{ $store->status == 'approved' ? '#d1fae5' : '#fef3c7' }}; color: {{ $store->status == 'approved' ? '#065f46' : '#b45309' }}; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: bold;">
                {{ strtoupper($store->status) }}
            </span>
        </div>

        <!-- Aksi (FORM YANG BENAR) -->
        <div>
            @if($store->status === 'pending')
                <form action="{{ route('admin.store.verify', $store->slug) }}" method="POST">
                    @csrf 
                    @method('PATCH') 
                    <button type="submit" class="web-button primary" style="padding: 8px 16px; font-size: 12px;">
                        Setujui Toko
                    </button>
                </form>
            @else
                <button class="web-button outline" disabled style="padding: 8px 16px; font-size: 12px;">Terverifikasi</button>
            @endif
        </div>

    </div>
    @empty
    <div style="padding: 24px; text-align: center; color: var(--muted);">Belum ada pengajuan toko.</div>
    @endforelse
</div>
@endsection