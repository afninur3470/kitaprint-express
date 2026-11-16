@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('home') }}" class="text-secondary text-sm hover:text-primary mb-2 inline-block">← Kembali ke Beranda</a>
        <h1 class="text-3xl font-bold text-dark tracking-tight">Unggah Dokumen</h1>
        <p class="text-secondary mt-1">Fotocopy Berkah Jaya • A4, Jilid, Express</p>
    </div>

    <!-- Split Layout 2 Kolom -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- KIRI: Upload Area -->
        <div class="bg-white rounded-card border-2 border-dashed border-border p-12 flex flex-col items-center justify-center text-center shadow-soft hover:border-primary transition cursor-pointer">
            <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-6 text-primary">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-dark mb-2">Pilih Berkas Anda</h3>
            <p class="text-secondary text-sm mb-6">PDF, DOCX, atau PPTX (Maksimal 50 MB)</p>
            <button class="bg-accent text-dark font-bold px-8 py-3 rounded-btn shadow-sm hover:bg-yellow-300 transition">
                Telusuri File
            </button>
        </div>

        <!-- KANAN: AI Live Preview (Muncul setelah upload - disimulasikan di sini) -->
        <div class="bg-white rounded-card border border-border p-6 shadow-soft">
            <div class="flex items-center space-x-4 mb-6 border-b border-border pb-4">
                <div class="w-16 h-20 bg-gray-200 rounded border border-gray-300 flex items-center justify-center text-gray-500 text-xs">PDF</div>
                <div>
                    <h4 class="font-bold text-dark text-lg">Laporan PKL.pdf</h4>
                    <p class="text-sm text-secondary">68 Halaman • 2.4 MB</p>
                </div>
                <button class="ml-auto text-sm font-semibold text-primary hover:underline">Ganti File</button>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-secondary text-sm">Estimasi Harga Cetak</span>
                    <span class="text-2xl font-bold text-primary">Rp 34.000</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary text-sm">Estimasi Waktu</span>
                    <span class="font-semibold text-dark">± 10 Menit</span>
                </div>
            </div>

            <div class="flex items-center space-x-2 text-xs text-primary bg-primary/5 p-3 rounded-lg mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span>Dihitung otomatis oleh AI KitaPrint</span>
            </div>

            <a href="{{ route('order.configure') }}" class="block w-full text-center bg-primary text-white font-bold py-3.5 rounded-btn shadow-md hover:bg-green-600 transition">
                Lanjut Konfigurasi Cetak
            </a>
        </div>
    </div>
</div>
@endsection