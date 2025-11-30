<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\FeedbackController; // Controller Baru
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\ScheduleController;
use Illuminate\Support\Facades\Route;

// Public Routes (Guest)

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/poli-list', [PublicController::class, 'polis'])->name('public.polis');
Route::get('/doctor-list', [PublicController::class, 'doctors'])->name('public.doctors');

// Dashboard Redirect

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated User Routes (Profile)

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Shared Routes (User, Doctor, Admin)

Route::middleware(['auth'])->group(function () {
    // Appointment Booking & List
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    
    // Medical Records History
    Route::get('/medical-records', [MedicalRecordController::class, 'index'])->name('medical_records.index');
    Route::get('/medical-records/{medicalRecord}', [MedicalRecordController::class, 'show'])->name('medical_records.show');

    // Feedback Submission (Untuk Pasien)
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});

 //Doctor Routes (Manager)

Route::middleware(['auth', 'manager'])->prefix('doctor')->name('doctor.')->group(function () {
    // Schedule Management
    Route::resource('schedules', ScheduleController::class);
    
    // Create Medical Record (Pemeriksaan)
    Route::get('/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical_records.create');
    Route::post('/medical-records', [MedicalRecordController::class, 'store'])->name('medical_records.store');
});

//Admin Routes

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Master Data CMS
    Route::resource('polis', PoliController::class);
    Route::resource('medicines', MedicineController::class);
    Route::resource('users', UserController::class);

    // Feedback Management (Lihat & Hapus Ulasan)
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::delete('/feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');
});

require __DIR__.'/auth.php';