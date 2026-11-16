@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold text-dark mb-6">Admin Dashboard - Verifikasi Toko</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($stores as $store)
        <div class="bg-white rounded-card border border-border p-5 shadow-soft">
            <h3 class="font-bold text-lg">{{ $store->name }}</h3>
            <p class="text-sm text-secondary">Pemilik: {{ $store->owner->name }}</p>
            <p class="text-sm">Status: <span class="font-bold {{ $store->status === 'approved' ? 'text-primary' : 'text-warning' }}">{{ strtoupper($store->status) }}</span></p>
            
            @if($store->status === 'pending')
            <form action="{{ route('admin.store.verify', $store->id) }}" method="POST" class="mt-4">
                @csrf @method('PATCH')
                <button class="w-full bg-primary text-white font-bold py-2 rounded-btn">Setujui Toko</button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection