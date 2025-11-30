<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Schedule;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Poli;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;


            // DASHBOARD ADMIN
            if ($role == 'admin') {
                // 1. Statistik Dasar
                $pendingAppointments = Appointment::where('status', 'pending')->count();
                $totalUsers = User::count();
                $totalDoctors = User::where('role', 'manager')->count();
                $totalPatients = User::where('role', 'user')->count();
                
                // 2. Dokter Bertugas Hari Ini
                $dayMap = [
                    'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
                    'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'
                ];
                $todayIndo = $dayMap[Carbon::now()->format('l')];

                $doctorsOnDuty = Schedule::where('day', $todayIndo)
                                    ->with('doctor.poli')
                                    ->get()
                                    ->unique('user_id');

                // 3. Analitik: Pasien per Poli
                $patientsPerPoli = Poli::withCount(['doctors as completed_appointments_count' => function($q) {
                    $q->join('appointments', 'users.id', '=', 'appointments.doctor_id')
                      ->where('appointments.status', 'completed');
                }])->get();

                // 4. Analitik: Top Performa Dokter
                $topDoctors = User::where('role', 'manager')
                    ->withCount(['appointments as total_treated' => function($q) {
                        $q->where('status', 'completed');
                    }])
                    ->orderByDesc('total_treated')
                    ->take(5)
                    ->get();

                // 5. Analitik: Obat Paling Banyak Digunakan
                $topMedicines = Medicine::withCount(['medicalRecords as total_usage' => function($q) {
                        $q->select(DB::raw('SUM(quantity)'));
                    }])
                    ->orderByDesc('total_usage')
                    ->take(5)
                    ->get();

                return view('dashboard.admin.home', compact(
                    'pendingAppointments', 
                    'totalUsers', 
                    'totalDoctors', 
                    'totalPatients', 
                    'doctorsOnDuty', 
                    'patientsPerPoli', 
                    'topDoctors',
                    'topMedicines'
                ));
            }

            // DASHBOARD DOKTER (MANAGER)

            if ($role == 'manager') {
                $doctorPending = Appointment::where('doctor_id', Auth::id())
                                            ->where('status', 'pending')
                                            ->count();
                
                $todayAppointments = Appointment::where('doctor_id', Auth::id())
                                            ->where('status', 'approved')
                                            ->whereDate('booking_date', Carbon::today())
                                            ->get();

                $recentExaminations = MedicalRecord::where('doctor_id', Auth::id())
                                            ->with('patient')
                                            ->latest()
                                            ->take(5)
                                            ->get();

                return view('dashboard.manager.home', compact('doctorPending', 'todayAppointments', 'recentExaminations'));
            }


            // DASHBOARD PASIEN (USER)
            $lastAppointment = Appointment::where('patient_id', Auth::id())->latest()->first();
            return view('dashboard.user.home', compact('lastAppointment'));

        } else {
            return redirect('login');
        }
    }
}