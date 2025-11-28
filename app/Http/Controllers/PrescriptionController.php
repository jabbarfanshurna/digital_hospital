<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function create($record_id)
    {
        $record = MedicalRecord::with('user', 'doctor.user')->findOrFail($record_id);
        return view('prescriptions.create', compact('record'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_record_id' => 'required',
            'obat' => 'required',
            'dosis' => 'required',
            'frekuensi' => 'required',
            'durasi' => 'nullable'
        ]);

        Prescription::create($request->all());

        return redirect()->route('medical_records.index')
            ->with('success', 'Resep berhasil ditambahkan.');
    }
}

