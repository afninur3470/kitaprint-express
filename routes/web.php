<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Customer\StoreRegistrationController;

Route::get('/', function () { return view('pages.app.home'); })->middleware(['auth'])->name('home');

Route::middleware(['auth'])->group(function () {
    // ================= ALUR PEMESANAN =================
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/upload', [OrderController::class, 'upload'])->name('upload');
        Route::post('/upload', [OrderController::class, 'processUpload'])->name('process-upload');
        Route::get('/configure', [OrderController::class, 'configure'])->name('configure');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('process');
        Route::get('/tracking', [OrderController::class, 'tracking'])->name('tracking');
    });

    // ================= ALUR DAFTAR USAHA (MITRA) =================
    Route::prefix('daftar-usaha')->name('store-registration.')->group(function () {
        Route::get('/', [StoreRegistrationController::class, 'index'])->name('index');
        Route::get('/form', [StoreRegistrationController::class, 'create'])->name('create');
        Route::post('/', [StoreRegistrationController::class, 'store'])->name('store');
        Route::get('/status', [StoreRegistrationController::class, 'status'])->name('status');
    });
});

// Rute Mitra
Route::middleware(['auth', 'role:mitra'])->prefix('mitra')->name('mitra.')->group(function () {
    Route::get('/dashboard', [OrderController::class, 'mitraDashboard'])->name('dashboard');
    Route::patch('/order/{order}/status', [OrderController::class, 'mitraUpdateStatus'])->name('order.update-status');
});

// Rute Kurir
Route::middleware(['auth', 'role:kurir'])->prefix('kurir')->name('kurir.')->group(function () {
    Route::get('/dashboard', [OrderController::class, 'kurirDashboard'])->name('dashboard');
    Route::post('/order/{order}/accept', [OrderController::class, 'kurirAccept'])->name('order.accept');
    Route::post('/order/{order}/complete', [OrderController::class, 'kurirComplete'])->name('order.complete');
});

// Rute Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\OrderController::class, 'adminDashboard'])->name('dashboard');
   Route::patch('/store/{id}/verify', [\App\Http\Controllers\OrderController::class, 'adminVerify'])->name('store.verify');
});

require __DIR__.'/auth.php';