<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // jika pasien, tampilkan pembayaran miliknya
        if (auth()->user()->role == 'patient') {
            $payments = Payment::with('record.user')
                    ->whereHas('record', fn($q) => $q->where('user_id', auth()->id()))
                    ->get();
        } else {
            // admin & dokter bisa lihat semua pembayaran
            $payments = Payment::with('record.user')->get();
        }

        return view('payments.index', compact('payments'));
    }

    public function create($record_id)
    {
        $record = MedicalRecord::with('prescriptions')->findOrFail($record_id);

        // hitung biaya obat
        $biaya_obat = count($record->prescriptions) * 10000; // Rp 10.000 per item

        return view('payments.create', [
            'record' => $record,
            'biaya_obat' => $biaya_obat
        ]);
    }

    public function store(Request $request)
    {
        $total = $request->biaya_konsultasi + 
                 $request->biaya_tindakan + 
                 $request->biaya_obat;

        Payment::create([
            'medical_record_id' => $request->record_id,
            'biaya_konsultasi' => $request->biaya_konsultasi,
            'biaya_tindakan' => $request->biaya_tindakan,
            'biaya_obat' => $request->biaya_obat,
            'total_biaya' => $total,
            'status' => 'unpaid'
        ]);

        return redirect()->route('payments.index')
            ->with('success', 'Tagihan berhasil dibuat.');
    }

    public function markPaid($id)
    {
        $pay = Payment::findOrFail($id);
        $pay->update(['status' => 'paid']);

        return back()->with('success', 'Pembayaran telah dikonfirmasi.');
    }
}

