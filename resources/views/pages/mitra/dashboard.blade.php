@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span>MITRA</span><h1>Pesanan Masuk</h1></div></div>
<div class="history-table">
    @forelse($incoming as $order)
    <div class="table-row flex justify-between items-center p-4 border-b">
        <div>
            <strong>{{ $order->document_name }}</strong>
            <p class="text-xs text-[var(--muted)]">{{ $order->total_pages }} Halaman</p>
        </div>
        <form action="{{ route('mitra.order.update-status', $order->id) }}" method="POST">
            @csrf @method('PATCH')
            <input type="hidden" name="status" value="printing">
            <button type="submit" class="web-button primary">Mulai Cetak</button>
        </form>
    </div>
    @empty
    <div class="p-6 text-center text-sm text-[var(--muted)]">Belum ada pesanan.</div>
    @endforelse
</div>
@endsection