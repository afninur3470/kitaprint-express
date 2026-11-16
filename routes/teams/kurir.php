<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kurir\DashboardController;

// Teman 5 HANYA mengedit file ini untuk route-nya

Route::middleware(['auth', 'role:kurir'])->prefix('kurir')->name('kurir.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/order/{order}/accept', [DashboardController::class, 'accept'])->name('order.accept');
    Route::post('/order/{order}/complete', [DashboardController::class, 'complete'])->name('order.complete');
});
