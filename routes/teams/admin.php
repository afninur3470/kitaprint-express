<?php
use Illuminate\Support\Facades\Route;

// Teman 6 HANYA mengedit file ini untuk route-nya

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function() {
        $stores = \App\Models\Store::with('owner')->latest()->get();
        return view('pages.admin.dashboard', compact('stores'));
    })->name('dashboard');

    Route::patch('/store/{store}/verify', function(\App\Models\Store $store) {
        $store->update(['status' => 'approved']);
        $store->owner->assignRole('mitra');
        return back()->with('success', 'Toko berhasil diverifikasi!');
    })->name('store.verify');
});
