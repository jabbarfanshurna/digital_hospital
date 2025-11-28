<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DoctorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
=======
>>>>>>> c5a50cb2d95973c93c4a7cbf0daf9dd6bd0558c6

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// Dashboard (khusus user yang sudah login & verified)
=======
>>>>>>> c5a50cb2d95973c93c4a7cbf0daf9dd6bd0558c6
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

<<<<<<< HEAD
// Semua route yang membutuhkan login
Route::middleware('auth')->group(function () {

    // Profile routes bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    // POLI module
    Route::resource('polis', PoliController::class);

    // DOCTOR module
    Route::resource('doctors', DoctorController::class);

});

Route::middleware(['auth'])->group(function () {
    Route::resource('jadwal', App\Http\Controllers\JadwalDokterController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('appointments', AppointmentController::class);
});

Route::middleware('auth')->group(function () {

    Route::post('/appointments/{id}/approve', 
        [App\Http\Controllers\AppointmentController::class, 'approve'])
        ->name('appointments.approve');

    Route::post('/appointments/{id}/reject', 
        [App\Http\Controllers\AppointmentController::class, 'reject'])
        ->name('appointments.reject');
});

Route::middleware('auth')->group(function () {
    Route::get('/medical-records', [MedicalRecordController::class, 'index'])
        ->name('medical_records.index');

    Route::get('/medical-records/create/{appointment_id}', 
        [MedicalRecordController::class, 'create'])
        ->name('medical_records.create');

    Route::post('/medical-records', 
        [MedicalRecordController::class, 'store'])
        ->name('medical_records.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/prescriptions/create/{record_id}', 
        [App\Http\Controllers\PrescriptionController::class, 'create'])
        ->name('prescriptions.create');

    Route::post('/prescriptions', 
        [App\Http\Controllers\PrescriptionController::class, 'store'])
        ->name('prescriptions.store');
});




// Auth routes (login, register, logout, dll)
=======
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('polis', App\Http\Controllers\PoliController::class);

});

>>>>>>> c5a50cb2d95973c93c4a7cbf0daf9dd6bd0558c6
require __DIR__.'/auth.php';
