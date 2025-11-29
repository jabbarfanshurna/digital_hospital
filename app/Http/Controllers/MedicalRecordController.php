<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- Baris ini sangat penting!
use Illuminate\Support\Facades\DB;

class MedicalRecordController extends Controller
{
    /**
     * Menampilkan daftar rekam medis.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = MedicalRecord::with(['patient', 'doctor', 'medicines']);

        // FITUR PENCARIAN (Requirement: Dokter cari pasien)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('patient', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($user->role === 'user') {
            // Pasien hanya melihat rekam medisnya sendiri
            $query->where('patient_id', $user->id);
        } elseif ($user->role === 'manager') {
            // Dokter melihat rekam medis yang dia buat
            $query->where('doctor_id', $user->id);
        }
        // Admin melihat semua

        $records = $query->latest()->get();

        return view('dashboard.medical_records.index', compact('records'));
    }

    /**
     * Form Konsultasi (Membuat Rekam Medis untuk Appointment tertentu).
     */
    public function create(Request $request)
    {
        // Pastikan ada appointment_id yang dikirim
        $appointmentId = $request->query('appointment_id');
        $appointment = Appointment::with('patient')->findOrFail($appointmentId);

        // Security check: Hanya dokter ybs yang bisa memeriksa
        if (Auth::user()->role !== 'manager' || $appointment->doctor_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Ambil daftar obat yang stoknya > 0
        $medicines = Medicine::where('stock', '>', 0)->get();

        return view('dashboard.medical_records.create', compact('appointment', 'medicines'));
    }

    /**
     * Simpan Rekam Medis & Resep.
     */
    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
            'medicines' => 'array', // Array of medicine IDs
            'medicines.*' => 'exists:medicines,id',
            'quantities' => 'array',
            'instructions' => 'array',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        // Gunakan Transaction agar data konsisten (Rollback jika error)
        DB::transaction(function () use ($request, $appointment) {
            
            // 1. Buat Rekam Medis
            $record = MedicalRecord::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $appointment->patient_id,
                'doctor_id' => $appointment->doctor_id,
                'diagnosis' => $request->diagnosis,
                'treatment' => $request->treatment,
                'notes' => $request->notes,
            ]);

            // 2. Simpan Resep Obat & Kurangi Stok
            if ($request->has('medicines')) {
                foreach ($request->medicines as $index => $medicineId) {
                    $qty = $request->quantities[$index] ?? 1;
                    $inst = $request->instructions[$index] ?? '-';

                    // Attach ke Pivot Table
                    $record->medicines()->attach($medicineId, [
                        'quantity' => $qty,
                        'instructions' => $inst
                    ]);

                    // Kurangi Stok Obat
                    $medicine = Medicine::find($medicineId);
                    if ($medicine) {
                        $medicine->decrement('stock', $qty);
                    }
                }
            }

            // 3. Update Status Appointment jadi 'Completed' (Selesai)
            $appointment->update(['status' => 'completed']);
        });

        return redirect()->route('medical_records.index')->with('success', 'Pemeriksaan selesai & Rekam medis disimpan.');
    }
    
    /**
     * Show detail (optional, for printing or viewing full details)
     */
    public function show(MedicalRecord $medicalRecord)
    {
        // Authorization check
        if (Auth::user()->role === 'user' && $medicalRecord->patient_id !== Auth::id()) {
            abort(403);
        }
        
        return view('dashboard.medical_records.show', compact('medicalRecord'));
    }
}