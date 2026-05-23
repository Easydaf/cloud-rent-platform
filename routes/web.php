<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Frontend UI Routes for Kim (Storage & Logs) - Menggunakan view dengan Mock Data
    Route::get('/storage/packages', function () {
        return view('storage.packages');
    })->name('storage.packages');

    // Route untuk konfirmasi paket yang dipilih user
    Route::get('/storage/confirm/{plan}', function ($plan) {
        $planDetails = [
            'basic' => ['name' => 'Basic', 'price' => 50000, 'storage' => '10 GB', 'desc' => 'Sempurna untuk personal dan tugas kuliah.'],
            'pro' => ['name' => 'Pro', 'price' => 150000, 'storage' => '50 GB', 'desc' => 'Ideal untuk tim dan developer profesional.'],
            'enterprise' => ['name' => 'Enterprise', 'price' => 500000, 'storage' => '500 GB', 'desc' => 'Skalabilitas penuh untuk proyek besar.'],
        ];
        
        $selectedPlan = $planDetails[$plan] ?? $planDetails['basic'];
        return view('storage.confirm', compact('selectedPlan', 'plan'));
    })->name('storage.confirm');
    
    Route::get('/logs', function () {
        return view('logs.index');
    })->name('logs.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
