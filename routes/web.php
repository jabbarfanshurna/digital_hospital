<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\AppointmentController; // Tambahkan ini
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
| Appointment Routes (Shared Logic)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Pasien Booking
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    
    // View & Manage Appointments (Semua Role bisa akses, logic filter di Controller)
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
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