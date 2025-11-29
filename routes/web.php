<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\UserController; // Tambahkan ini
use App\Http\Controllers\Doctor\ScheduleController; // Tambahkan ini
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Public Route (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN ROUTES
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('polis', PoliController::class);
    Route::resource('medicines', MedicineController::class);
    Route::resource('users', UserController::class); // User Management
});

// DOCTOR ROUTES (Gunakan middleware 'manager' sesuai setup awal Anda untuk Dokter/Manager)
Route::middleware(['auth', 'manager'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::resource('schedules', ScheduleController::class); // Schedule Management
});



/*
|--------------------------------------------------------------------------
| Auth (login, register, logout)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';