<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController; // Tambahkan ini
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\ScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/poli-list', [PublicController::class, 'polis'])->name('public.polis');
Route::get('/doctor-list', [PublicController::class, 'doctors'])->name('public.doctors');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Profile)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('polis', PoliController::class);
    Route::resource('medicines', MedicineController::class);
    Route::resource('users', UserController::class);
});

/*
|--------------------------------------------------------------------------
| Doctor Routes (Manager)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'manager'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::resource('schedules', ScheduleController::class);
});

require __DIR__.'/auth.php';