<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Appointment;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        // Untuk dokter & admin → melihat semua
        if (auth()->user()->role != 'patient') {
            $records = MedicalRecord::with(['doctor.user', 'user'])->get();
        } 
        // Untuk pasien → lihat rekam medis sendiri
        else {
            $records = MedicalRecord::with(['doctor.user', 'user'])
                ->where('user_id', auth()->id())
                ->get();
        }

        return view('medical_records.index', compact('records'));
    }

    public function create($appointment_id)
    {
        $appointment = Appointment::with('doctor.user','user')->findOrFail($appointment_id);
        return view('medical_records.create', compact('appointment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required',
            'diagnosa' => 'required',
            'tindakan' => 'nullable',
            'catatan' => 'nullable',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        MedicalRecord::create([
            'appointment_id' => $appointment->id,
            'doctor_id' => $appointment->doctor_id,
            'user_id' => $appointment->user_id,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'catatan' => $request->catatan,
        ]);

        // ubah status appointment menjadi done
        $appointment->update(['status' => 'done']);

        return redirect()->route('medical_records.index')
                ->with('success', 'Rekam medis berhasil disimpan.');
    }
}

