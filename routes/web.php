<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.app.home');
})->middleware(['auth', 'verified'])->name('home');

// Profile Routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// PISAHKAN ROUTE TIM AGAR TIDAK BENTROK
// ==========================================
Route::middleware(['auth'])->group(function () {
    require __DIR__.'/teams/customer.php'; // Dipegang Teman 3
    require __DIR__.'/teams/mitra.php';    // Dipegang Teman 4
    require __DIR__.'/teams/kurir.php';    // Dipegang Teman 5
    require __DIR__.'/teams/admin.php';    // Dipegang Teman 6
});

require __DIR__.'/auth.php';