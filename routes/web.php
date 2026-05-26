<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\StorageController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Routes for Storage Rental and Activity Logs (Kim's Jobdesk - Integrated with DB)
    Route::get('/storage/packages', [App\Http\Controllers\StorageController::class, 'packages'])->name('storage.packages');
    Route::get('/storage/confirm/{slug}', [App\Http\Controllers\StorageController::class, 'confirm'])->name('storage.confirm');
    Route::post('/storage/purchase', [App\Http\Controllers\StorageController::class, 'purchase'])->name('storage.purchase');
    Route::get('/logs', [App\Http\Controllers\StorageController::class, 'logs'])->name('logs.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
