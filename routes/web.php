<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DoctorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (khusus user yang sudah login & verified)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::middleware('auth')->group(function () {

    Route::get('/payments', 
        [App\Http\Controllers\PaymentController::class, 'index'])
        ->name('payments.index');

    Route::get('/payments/create/{record_id}', 
        [App\Http\Controllers\PaymentController::class, 'create'])
        ->name('payments.create');

    Route::post('/payments', 
        [App\Http\Controllers\PaymentController::class, 'store'])
        ->name('payments.store');

    Route::post('/payments/{id}/paid', 
        [App\Http\Controllers\PaymentController::class, 'markPaid'])
        ->name('payments.paid');
});





// Auth routes (login, register, logout, dll)
require __DIR__.'/auth.php';
