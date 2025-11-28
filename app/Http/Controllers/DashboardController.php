<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Poli;
use App\Models\Payment;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik kotak
        $totalPatients = User::where('role', 'patient')->count();
        $totalDoctors = User::where('role', 'doctor')->count();
        $totalPoli     = Poli::count();

        $paidPayments   = Payment::where('status', 'paid')->sum('total_biaya');
        $unpaidPayments = Payment::where('status', 'unpaid')->sum('total_biaya');

        // Grafik pasien per bulan
        $patientChart = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->where('role', 'patient')
            ->groupBy('month')
            ->pluck('total', 'month');

        // Grafik pendapatan per bulan
        $incomeChart = Payment::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_biaya) as total')
            )
            ->where('status', 'paid')
            ->groupBy('month')
            ->pluck('total', 'month');

        // aktivitas terbaru
        $latestRecords = MedicalRecord::with(['user','doctor'])
                        ->orderBy('id','desc')
                        ->take(5)->get();

        return view('dashboard.index', compact(
            'totalPatients',
            'totalDoctors',
            'totalPoli',
            'paidPayments',
            'unpaidPayments',
            'patientChart',
            'incomeChart',
            'latestRecords'
        ));
    }
}
