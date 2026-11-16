<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Ulang Usaha</h2>
            <a href="{{ route('store-registration.status') }}" class="text-sm text-gray-600 hover:underline">← Kembali ke Status</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Notifikasi penolakan sebelumnya --}}
            @if ($store->rejection_reason)
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="font-semibold text-red-800 mb-1">Alasan penolakan sebelumnya:</p>
                    <p class="text-red-700 text-sm">{{ $store->rejection_reason }}</p>
                    <p class="text-xs text-red-600 mt-2">Silakan perbaiki data di bawah ini sebelum mendaftar ulang.</p>
                </div>
            @endif

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error validasi --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="font-semibold text-red-700 mb-2">Periksa kembali isian Anda:</p>
                    <ul class="text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('store-registration.resubmit') }}" method="POST"
                  enctype="multipart/form-data" class="bg-white shadow-sm rounded-lg p-8 space-y-8">
                @csrf

                {{-- Section 1: Identitas Usaha --}}
                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">1. Identitas Usaha</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Nama Usaha *</label>
                            <input type="text" name="name" value="{{ old('name', $store->name) }}" required
                                   class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Jenis Usaha *</label>
                            <select name="business_type" required
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">— Pilih —</option>
                                @foreach ($businessTypes as $val => $label)
                                    <option value="{{ $val }}"
                                        @selected(old('business_type', $store->business_type->value) === $val)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Logo Usaha</label>
                            <input type="file" name="logo" accept="image/*"
                                   class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700">
                            @if ($store->logo)
                                <p class="text-xs text-gray-500 mt-1">Logo saat ini: <a href="{{ Storage::url($store->logo) }}" target="_blank" class="text-indigo-600 underline">Lihat</a> (kosongkan jika tidak diubah)</p>
                            @endif
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Deskripsi Singkat</label>
                            <textarea name="description" rows="3"
                                      class="w-full rounded-lg border-gray-300">{{ old('description', $store->description) }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Foto Toko</label>
                            <input type="file" name="store_photo" accept="image/*"
                                   class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700">
                            @if ($store->store_photo)
                                <p class="text-xs text-gray-500 mt-1">Foto saat ini: <a href="{{ Storage::url($store->store_photo) }}" target="_blank" class="text-indigo-600 underline">Lihat</a> (kosongkan jika tidak diubah)</p>
                            @endif
                        </div>
                    </div>
                </section>

                {{-- Section 2: Kontak & Alamat --}}
                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">2. Kontak & Alamat</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nomor Telepon *</label>
                            <input type="text" name="phone" value="{{ old('phone', $store->phone) }}" required
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Email *</label>
                            <input type="email" name="email" value="{{ old('email', $store->email) }}" required
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Alamat Lengkap *</label>
                            <textarea name="address" rows="2" required
                                      class="w-full rounded-lg border-gray-300">{{ old('address', $store->address) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Kota *</label>
                            <input type="text" name="city" value="{{ old('city', $store->city) }}" required
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Provinsi *</label>
                            <input type="text" name="province" value="{{ old('province', $store->province) }}" required
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Kode Pos *</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', $store->postal_code) }}" required
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                    </div>
                </section>

                {{-- Section 3: Dokumen Verifikasi --}}
                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">3. Dokumen Verifikasi</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nomor KTP (16 digit) *</label>
                            <input type="text" name="ktp_number" value="{{ old('ktp_number', $store->ktp_number) }}" required
                                   maxlength="16" class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Foto KTP</label>
                            <input type="file" name="ktp_photo" accept="image/*"
                                   class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700">
                            @if ($store->ktp_photo)
                                <p class="text-xs text-gray-500 mt-1">Foto KTP saat ini: <a href="{{ Storage::url($store->ktp_photo) }}" target="_blank" class="text-indigo-600 underline">Lihat</a> (kosongkan jika tidak diubah)</p>
                            @else
                                <p class="text-xs text-red-500 mt-1">Foto KTP wajib diunggah.</p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Nomor NIB</label>
                            <input type="text" name="nib_number" value="{{ old('nib_number', $store->nib_number) }}"
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Foto NIB</label>
                            <input type="file" name="nib_photo" accept="image/*"
                                   class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700">
                            @if ($store->nib_photo)
                                <p class="text-xs text-gray-500 mt-1">Foto NIB saat ini: <a href="{{ Storage::url($store->nib_photo) }}" target="_blank" class="text-indigo-600 underline">Lihat</a></p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Nomor NPWP</label>
                            <input type="text" name="npwp_number" value="{{ old('npwp_number', $store->npwp_number) }}"
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Foto Izin Usaha</label>
                            <input type="file" name="business_license_photo" accept="image/*"
                                   class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700">
                            @if ($store->business_license_photo)
                                <p class="text-xs text-gray-500 mt-1">Izin Usaha saat ini: <a href="{{ Storage::url($store->business_license_photo) }}" target="_blank" class="text-indigo-600 underline">Lihat</a></p>
                            @endif
                        </div>
                    </div>
                </section>

                {{-- Section 4: Rekening --}}
                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">4. Rekening Pencairan</h3>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Bank *</label>
                            <input type="text" name="bank_name" value="{{ old('bank_name', $store->bank_name) }}" required
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">No. Rekening *</label>
                            <input type="text" name="bank_account_number" value="{{ old('bank_account_number', $store->bank_account_number) }}" required
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Pemilik *</label>
                            <input type="text" name="bank_account_name" value="{{ old('bank_account_name', $store->bank_account_name) }}" required
                                   class="w-full rounded-lg border-gray-300">
                        </div>
                    </div>
                </section>

                {{-- Persetujuan --}}
                <div class="border-t pt-6">
                    <label class="flex items-start gap-3">
                        <input type="checkbox" name="agree_terms" value="1" required
                               class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm text-gray-700">
                            Saya menyatakan data yang diisi adalah benar dan menyetujui syarat & ketentuan Kitaprint Express.
                        </span>
                    </label>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('store-registration.status') }}"
                       class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit"
                            class="px-8 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
                        Kirim Pendaftaran Ulang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>