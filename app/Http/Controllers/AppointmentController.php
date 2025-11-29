<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Poli;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Menampilkan daftar janji temu (Sesuai Role).
     */
    public function index()
    {
        $user = Auth::user();
        $query = Appointment::with(['patient', 'doctor', 'schedule', 'doctor.poli']);

        if ($user->role === 'user') {
            // Pasien hanya melihat janji temunya sendiri
            $query->where('patient_id', $user->id);
        } elseif ($user->role === 'manager') {
            // Dokter hanya melihat janji temu yang ditujukan padanya
            $query->where('doctor_id', $user->id);
        }
        // Admin melihat semua (tidak perlu filter tambahan)

        $appointments = $query->orderBy('booking_date', 'desc')->get();

        return view('dashboard.appointments.index', compact('appointments'));
    }

    /**
     * Menampilkan form buat janji temu (Khusus Pasien).
     */
    public function create(Request $request)
    {
        // Step 1: Ambil semua poli untuk dropdown
        $polis = Poli::all();
        
        // Step 2 (Jika Poli dipilih): Ambil dokter di poli tersebut
        $doctors = [];
        if ($request->has('poli_id')) {
            $doctors = User::where('role', 'manager')
                           ->where('poli_id', $request->poli_id)
                           ->with('schedules')
                           ->get();
        }

        return view('dashboard.appointments.create', compact('polis', 'doctors'));
    }

    /**
     * Menyimpan janji temu baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'complaint' => 'required|string|max:255',
        ]);

        // Validasi: Pastikan tanggal yang dipilih sesuai dengan HARI jadwal dokter
        $schedule = Schedule::findOrFail($request->schedule_id);
        $bookingDate = Carbon::parse($request->booking_date);
        
        // Mapping nama hari Carbon (English) ke Database (Indonesia)
        $dayMap = [
            'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'
        ];
        $bookingDayName = $bookingDate->format('l'); // e.g., "Monday"
        $indonesianDay = $dayMap[$bookingDayName];

        if ($schedule->day !== $indonesianDay) {
            return back()->withErrors(['booking_date' => "Tanggal yang dipilih adalah hari $indonesianDay, tetapi jadwal dokter adalah hari $schedule->day."])->withInput();
        }

        Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'schedule_id' => $request->schedule_id,
            'booking_date' => $request->booking_date,
            'complaint' => $request->complaint,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dibuat! Mohon tunggu konfirmasi.');
    }

    /**
     * Update Status (Approve/Reject) oleh Dokter/Admin.
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Pastikan hanya Admin atau Dokter ybs yang bisa update
        if (Auth::user()->role !== 'admin' && Auth::id() !== $appointment->doctor_id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_note' => 'nullable|string',
        ]);

        $appointment->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note,
        ]);

        return back()->with('success', 'Status janji temu diperbarui.');
    }
}