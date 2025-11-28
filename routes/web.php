<?php

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


/*
|--------------------------------------------------------------------------
| Dashboard (Login & Verified required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Routes yang membutuhkan Login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | POLI Module CRUD
    |--------------------------------------------------------------------------
    */
    Route::resource('polis', PoliController::class);


    /*
    |--------------------------------------------------------------------------
    | DOCTOR Module CRUD
    |--------------------------------------------------------------------------
    */
    Route::resource('doctors', DoctorController::class);


    /*
    |--------------------------------------------------------------------------
    | JADWAL Dokter
    |--------------------------------------------------------------------------
    */
    Route::resource('jadwal', JadwalDokterController::class);


    /*
    |--------------------------------------------------------------------------
    | APPOINTMENT (Booking Pasien + Approval Dokter/Admin)
    |--------------------------------------------------------------------------
    */

    // PASIEN melihat appointment miliknya
    Route::get('/appointments', [AppointmentController::class, 'index'])
        ->name('appointments.index');

    // PASIEN membuat appointment
    Route::get('/appointments/create', [AppointmentController::class, 'create'])
        ->name('appointments.create');
    Route::post('/appointments/store', [AppointmentController::class, 'store'])
        ->name('appointments.store');

    // PASIEN membatalkan appointment
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])
        ->name('appointments.destroy');

    // DOKTER melihat appointment pasiennya
    Route::get('/doctor/appointments', [AppointmentController::class, 'doctorAppointments'])
        ->name('doctor.appointments');

    // APPROVE / REJECT (dokter / admin)
    Route::post('/appointments/{id}/approve', [AppointmentController::class, 'approve'])
        ->name('appointments.approve');

    Route::post('/appointments/{id}/reject', [AppointmentController::class, 'reject'])
        ->name('appointments.reject');


    /*
    |--------------------------------------------------------------------------
    | MEDICAL RECORDS
    |--------------------------------------------------------------------------
    */
    Route::get('/medical-records', [MedicalRecordController::class, 'index'])
        ->name('medical_records.index');

    Route::get('/medical-records/create/{appointment_id}', [MedicalRecordController::class, 'create'])
        ->name('medical_records.create');

    Route::post('/medical-records', [MedicalRecordController::class, 'store'])
        ->name('medical_records.store');


    /*
    |--------------------------------------------------------------------------
    | PRESCRIPTIONS (Resep Obat)
    |--------------------------------------------------------------------------
    */
    Route::get('/prescriptions/create/{record_id}', [PrescriptionController::class, 'create'])
        ->name('prescriptions.create');

    Route::post('/prescriptions', [PrescriptionController::class, 'store'])
        ->name('prescriptions.store');


    /*
    |--------------------------------------------------------------------------
    | PAYMENTS (Pembayaran)
    |--------------------------------------------------------------------------
    */
    Route::get('/payments', [PaymentController::class, 'index'])
        ->name('payments.index');

    Route::get('/payments/create/{record_id}', [PaymentController::class, 'create'])
        ->name('payments.create');

    Route::post('/payments', [PaymentController::class, 'store'])
        ->name('payments.store');

    Route::post('/payments/{id}/paid', [PaymentController::class, 'markPaid'])
        ->name('payments.paid');
});
Route::middleware('auth')->group(function () {

    Route::get('/doctor/appointments', 
        [App\Http\Controllers\AppointmentController::class, 'doctorIndex'])
        ->name('appointments.doctor');
});



/*
|--------------------------------------------------------------------------
| Auth (login, register, logout)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
