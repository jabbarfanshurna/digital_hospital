<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use App\Models\Doctor;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $jadwals = JadwalDokter::with('doctor')->get();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('jadwal.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalDokter::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $doctors = Doctor::all();
        return view('jadwal.edit', compact('jadwal', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal berhasil dihapus');
    }
}
