<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mitra\DashboardController;

// Teman 4 HANYA mengedit file ini untuk route-nya

Route::middleware(['auth', 'role:mitra'])->prefix('mitra')->name('mitra.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::patch('/order/{order}/status', [DashboardController::class, 'updateStatus'])->name('order.update-status');
});
