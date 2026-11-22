@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span>ALUR PEMESANAN</span><h1>Unggah Dokumen</h1></div></div>
<div class="white-card p-8 text-center border-2 border-dashed max-w-2xl mx-auto">
    <form action="{{ route('order.process-upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="text-5xl mb-4">☁️</div>
        <h3 class="font-bold text-lg mb-2">Pilih Dokumen PDF/Word</h3>
        <input type="file" name="document" required class="block w-full text-sm mb-6 mx-auto file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-[var(--green-soft)] file:text-[var(--green-dark)] cursor-pointer">
        <button type="submit" class="web-button primary w-full">Lanjut Konfigurasi</button>
    </form>
</div>
@endsection