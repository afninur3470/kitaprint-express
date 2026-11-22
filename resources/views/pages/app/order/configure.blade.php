@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span>ALUR PEMESANAN</span><h1>Konfigurasi Cetak</h1></div></div>
<form action="{{ route('order.checkout') }}" method="GET" class="white-card p-6 max-w-2xl mx-auto">
    <h3 class="font-bold mb-4">Pengaturan Kertas & Jilid</h3>
    
    <label class="block mb-2 font-bold text-sm">Ukuran Kertas</label>
    <select name="paper_size" class="w-full p-3 border rounded-xl mb-4">
        <option value="A4">A4 (21 x 29.7 cm)</option>
        <option value="A5">A5 (14.8 x 21 cm)</option>
    </select>

    <label class="block mb-2"><input type="checkbox" name="is_binding" value="1"> Tambahkan Jilid (+Rp 15.000)</label>
    <label class="block mb-4"><input type="checkbox" name="is_express" value="1"> Cetak Express (+Rp 2.000)</label>

    <button type="submit" class="web-button primary w-full">Lanjut ke Checkout</button>
</form>
@endsection