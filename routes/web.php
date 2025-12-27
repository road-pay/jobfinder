<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Job; 

// AREA PUBLIK
Route::get('/', function () {
    $jobs = Job::latest();
    if (request('q')) {
        $jobs->where('title', 'like', '%' . request('q') . '%');
    }
    return view('welcome', ['jobs' => $jobs->paginate(10)]);
});

// AREA KHUSUS MEMBER
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        $jobs = Job::where('user_id', Auth::id())->latest()->paginate(10); 
        return view('dashboard', ['jobs' => $jobs]);
    })->name('dashboard');

    // CRUD JOBS
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    
    // PERBAIKAN: Gunakan patch agar sesuai dengan form @method('PATCH')
    Route::patch('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update'); 
    
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// DETAIL (Wajib paling bawah)
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

require __DIR__.'/auth.php';