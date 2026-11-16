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
    // Teman 3 mengedit file ini
    require __DIR__.'/teams/customer.php'; 
    
    // Teman 4 mengedit file ini
    require __DIR__.'/teams/mitra.php';    
    
    // Teman 5 mengedit file ini
    require __DIR__.'/teams/kurir.php';    
    
    // Teman 6 mengedit file ini (Admin)
    require __DIR__.'/teams/admin.php';    
});

require __DIR__.'/auth.php';