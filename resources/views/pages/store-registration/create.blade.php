@extends('layouts.mobile')

@section('content')
<div class="px-6 pt-4 pb-4 flex items-center bg-white sticky top-0 z-40 border-b border-border">
    <a href="{{ route('store-registration.index') }}" class="mr-4 text-dark">←</a>
    <h1 class="text-lg font-bold text-dark">Formulir Verifikasi</h1>
</div>

<div class="p-6">
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-btn text-xs text-danger">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('store-registration.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="bg-white p-5 rounded-card border border-border shadow-soft space-y-4">
            <h3 class="font-bold text-dark text-base border-b border-border pb-2">1. Identitas Usaha</h3>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Nama Usaha *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Jenis Usaha *</label>
                <select name="business_type" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm focus:ring-primary">
                    <option value="">— Pilih —</option>
                    @foreach ($businessTypes as $val => $label)
                        <option value="{{ $val }}" @selected(old('business_type') === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Foto Toko</label>
                <input type="file" name="store_photo" accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-btn file:border-0 file:bg-primary/10 file:text-primary">
            </div>
        </div>

        <div class="bg-white p-5 rounded-card border border-border shadow-soft space-y-4">
            <h3 class="font-bold text-dark text-base border-b border-border pb-2">2. Kontak & Alamat</h3>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Nomor Telepon *</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Alamat Lengkap *</label>
                <textarea name="address" rows="2" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm">{{ old('address') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-semibold text-dark mb-1">Kota *</label>
                    <input type="text" name="city" value="{{ old('city') }}" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-dark mb-1">Kode Pos *</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code') }}" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm">
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-card border border-border shadow-soft space-y-4">
            <h3 class="font-bold text-dark text-base border-b border-border pb-2">3. Dokumen Verifikasi</h3>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Nomor KTP (16 digit) *</label>
                <input type="text" name="ktp_number" value="{{ old('ktp_number') }}" required maxlength="16" class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Upload KTP *</label>
                <input type="file" name="ktp_photo" accept="image/*" required class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-btn file:border-0 file:bg-primary/10 file:text-primary">
            </div>
        </div>

        <div class="bg-white p-5 rounded-card border border-border shadow-soft space-y-4">
            <h3 class="font-bold text-dark text-base border-b border-border pb-2">4. Rekening Pencairan</h3>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Nama Bank *</label>
                <input type="text" name="bank_name" value="{{ old('bank_name') }}" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">No Rekening *</label>
                <input type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-dark mb-1">Nama Pemilik *</label>
                <input type="text" name="bank_account_name" value="{{ old('bank_account_name') }}" required class="w-full bg-gray-50 border border-border rounded-btn py-3 px-4 text-sm">
            </div>
        </div>

        <div class="flex items-start space-x-3 bg-gray-50 p-4 rounded-btn border border-border">
            <input type="checkbox" name="agree_terms" value="1" required class="mt-1 rounded border-gray-300 text-primary focus:ring-primary">
            <span class="text-xs text-secondary">Saya menyatakan data ini benar dan menyetujui Syarat & Ketentuan.</span>
        </div>

        <button type="submit" class="w-full bg-primary text-white font-bold py-3.5 rounded-btn shadow-soft mb-8">Kirim Pendaftaran</button>
    </form>
</div>
@endsection