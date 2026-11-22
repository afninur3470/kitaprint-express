@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span>ALUR PEMESANAN</span><h1>Checkout</h1></div></div>
<form action="{{ route('order.process') }}" method="POST">
    @csrf
    <!-- Bawa data dari halaman sebelumnya -->
    <input type="hidden" name="paper_size" value="{{ request('paper_size') }}">
    <input type="hidden" name="is_binding" value="{{ request('is_binding') }}">
    <input type="hidden" name="is_express" value="{{ request('is_express') }}">

    <div class="white-card p-6 mb-4">
        <h3 class="font-bold mb-4">Pilih Pengantaran</h3>
        @foreach($deliveryOptions as $key => $opt)
        <label class="block p-4 border rounded-xl mb-2 cursor-pointer hover:bg-gray-50">
            <input type="radio" name="delivery_type" value="{{ $key }}" required>
            <strong class="ml-2">{{ $opt['label'] }}</strong>
            <p class="text-xs text-[var(--muted)] ml-6">{{ $opt['desc'] }}</p>
        </label>
        @endforeach
    </div>

    <div class="white-card p-6 mb-4">
        <label class="block mb-2"><input type="checkbox" name="is_splitbill" value="1"> Aktifkan Splitbill (Patungan)</label>
        <label class="block"><input type="radio" name="payment_method" value="QRIS" checked> QRIS</label>
        <label class="block"><input type="radio" name="payment_method" value="GoPay"> GoPay</label>
    </div>

    <button type="submit" class="web-button primary w-full">Bayar & Pesan Sekarang</button>
</form>
@endsection