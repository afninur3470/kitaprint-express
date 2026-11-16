<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\StoreRegistrationController;

// Teman 3 HANYA mengedit file ini untuk route-nya

// Rute Daftar Usaha (Pengguna Umum)
Route::prefix('daftar-usaha')->name('store-registration.')->group(function () {
    Route::get('/', [StoreRegistrationController::class, 'index'])->name('index');
    Route::get('/form', [StoreRegistrationController::class, 'create'])->name('create');
    Route::post('/', [StoreRegistrationController::class, 'store'])->name('store');
    Route::get('/status', [StoreRegistrationController::class, 'status'])->name('status');
});

// Rute Order
Route::prefix('order')->name('order.')->group(function () {
    Route::get('/upload', [OrderController::class, 'upload'])->name('upload');
    Route::get('/configure', [OrderController::class, 'configure'])->name('configure');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('process');
    Route::get('/tracking', [OrderController::class, 'tracking'])->name('tracking');
    Route::get('/rating', [OrderController::class, 'rating'])->name('rating');
});
