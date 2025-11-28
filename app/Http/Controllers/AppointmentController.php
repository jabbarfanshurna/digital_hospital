<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Halaman appointment untuk PASIEN (melihat janji miliknya)
     */
    public function index()
    {
        $appointments = Appointment::with(['doctor.user', 'poli'])
            ->where('user_id', Auth::id())
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Halaman form booking (pasien memilih dokter & jadwal)
     */
    public function create()
    {
        $doctors = Doctor::with('poli')->get();
        return view('appointments.create', compact('doctors'));
    }

    /**
     * Proses membuat appointment
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'keluhan' => 'nullable'
        ]);

        // Ambil poli dokter
        $doctor = Doctor::findOrFail($request->doctor_id);

        Appointment::create([
            'user_id'    => Auth::id(),
            'doctor_id'  => $request->doctor_id,
            'poli_id'    => $doctor->poli_id, // otomatis
            'tanggal'    => $request->tanggal,
            'jam'        => $request->jam,
            'keluhan'    => $request->keluhan,
            'status'     => 'pending',
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment berhasil dibuat! Menunggu persetujuan dokter.');
    }

    /**
     * PASIEN membatalkan appointment miliknya
     */
    public function destroy($id)
    {
        $app = Appointment::findOrFail($id);

        if ($app->user_id != Auth::id()) {
            abort(403);
        }

        // Appointment yang sudah approved tidak boleh dibatalkan
        if ($app->status == 'approved') {
            return back()->with('error', 'Appointment sudah disetujui dan tidak dapat dibatalkan.');
        }

        $app->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment berhasil dibatalkan.');
    }

    /**
     * Dokter melihat appointment pasiennya
     */
    public function doctorAppointments()
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Anda bukan dokter.');
        }

        $appointments = Appointment::with(['user', 'poli'])
            ->where('doctor_id', $doctor->id)
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('appointments.doctor_index', compact('appointments'));
    }

    /**
     * Dokter/ Admin menyetujui appointment
     */
    public function approve($id)
    {
        $app = Appointment::findOrFail($id);

        if (!in_array(auth()->user()->role, ['admin', 'doctor'])) {
            abort(403);
        }

        $app->update(['status' => 'approved']);

        return back()->with('success', 'Appointment disetujui.');
    }

    /**
     * Dokter/ Admin menolak appointment
     */
    public function reject($id)
    {
        $app = Appointment::findOrFail($id);

        if (!in_array(auth()->user()->role, ['admin', 'doctor'])) {
            abort(403);
        }

        $app->update(['status' => 'rejected']);

        return back()->with('success', 'Appointment ditolak.');
    }
    public function doctorIndex()
    {
        // hanya admin & dokter yg boleh lihat
        if (!in_array(auth()->user()->role, ['admin', 'doctor'])) {
            abort(403);
        }

        $appointments = Appointment::with(['user', 'doctor.user', 'doctor.poli'])->get();

        return view('appointments.doctor_index', compact('appointments'));
    }

}
