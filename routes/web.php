<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController; // <--- Penting: Kita panggil Controller Job di sini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Grup Rute yang butuh Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Dashboard (Menampilkan daftar lowongan dari JobController)
    Route::get('/dashboard', [JobController::class, 'index'])->name('dashboard');

    // 2. Buat Lowongan Baru (Tampilkan Form)
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');

    // 3. Simpan Lowongan (Proses Kirim Data)
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

    // Fitur Profil Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';