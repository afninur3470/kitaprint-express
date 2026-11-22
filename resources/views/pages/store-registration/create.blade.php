@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div>
        <span>DAFTAR MITRA</span>
        <h1>Formulir Pendaftaran Usaha</h1>
        <p>Lengkapi data di bawah ini untuk bergabung menjadi Mitra KitaPrint.</p>
    </div>
    <a href="{{ route('store-registration.index') }}" class="web-button outline">← Kembali</a>
</div>

<div class="max-w-4xl mx-auto">
    <form action="{{ route('store-registration.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="space-y-6">
            
            <!-- SEKSI 1: IDENTITAS USAHA -->
            <div class="white-card p-6">
                <h3 class="font-bold text-lg mb-4 border-b border-[var(--border)] pb-2 text-[var(--ink)]">1. Identitas Usaha</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-2">Nama Usaha *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none" placeholder="Contoh: Fotocopy Berkah Jaya">
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Jenis Usaha *</label>
                        <select name="business_type" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">
                            <option value="">— Pilih Jenis —</option>
                            @foreach ($businessTypes as $val => $label)
                                <option value="{{ $val }}" @selected(old('business_type') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold mb-2">Foto Toko (Tampak Depan)</label>
                        <input type="file" name="store_photo" accept="image/*" class="w-full text-sm file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:bg-[var(--green-soft)] file:text-[var(--green-dark)] file:font-bold hover:file:bg-[var(--green)] hover:file:text-white transition cursor-pointer border border-[var(--border)] rounded-xl">
                    </div>
                </div>
            </div>

            <!-- SEKSI 2: KONTAK & ALAMAT -->
            <div class="white-card p-6">
                <h3 class="font-bold text-lg mb-4 border-b border-[var(--border)] pb-2 text-[var(--ink)]">2. Kontak & Alamat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-2">Nomor Telepon *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold mb-2">Alamat Lengkap *</label>
                        <textarea name="address" rows="2" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">{{ old('address') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Kota *</label>
                        <input type="text" name="city" value="{{ old('city') }}" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Kode Pos *</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">
                    </div>
                </div>
            </div>

            <!-- SEKSI 3: DOKUMEN VERIFIKASI -->
            <div class="white-card p-6">
                <h3 class="font-bold text-lg mb-4 border-b border-[var(--border)] pb-2 text-[var(--ink)]">3. Dokumen Verifikasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-2">Nomor KTP (16 digit) *</label>
                        <input type="text" name="ktp_number" value="{{ old('ktp_number') }}" required maxlength="16" class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Upload Foto KTP *</label>
                        <input type="file" name="ktp_photo" accept="image/*" required class="w-full text-sm file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:bg-[var(--green-soft)] file:text-[var(--green-dark)] file:font-bold hover:file:bg-[var(--green)] hover:file:text-white transition cursor-pointer border border-[var(--border)] rounded-xl">
                    </div>
                </div>
            </div>

            <!-- SEKSI 4: REKENING -->
            <div class="white-card p-6">
                <h3 class="font-bold text-lg mb-4 border-b border-[var(--border)] pb-2 text-[var(--ink)]">4. Rekening Pencairan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-2">Nama Bank *</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name') }}" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">No Rekening *</label>
                        <input type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Nama Pemilik *</label>
                        <input type="text" name="bank_account_name" value="{{ old('bank_account_name') }}" required class="w-full bg-gray-50 border border-[var(--border)] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[var(--green)] outline-none">
                    </div>
                </div>
            </div>

            <!-- PERSETUJUAN & SUBMIT -->
            <div class="white-card p-6 bg-[var(--lime-soft)] border-[#e4ed70]">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="agree_terms" value="1" required class="mt-1 w-4 h-4 text-[var(--green)] rounded border-gray-300 focus:ring-[var(--green)]">
                    <span class="text-sm text-[#525d18]">Saya menyatakan bahwa data yang diisi adalah benar dan menyetujui Syarat & Ketentuan Mitra KitaPrint Express.</span>
                </label>
                <button type="submit" class="web-button primary w-full mt-6" style="background: var(--green); color: white;">Kirim Pendaftaran Usaha</button>
            </div>

        </div>
    </form>
</div>
@endsection