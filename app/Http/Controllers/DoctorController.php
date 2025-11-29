<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['user','poli'])->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $users = User::where('role', 'doctor')->get();
        $polis = Poli::all();
        return view('doctors.create', compact('users', 'polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'poli_id' => 'required',
            'specialization' => 'required',
            'license_number' => 'required',
            'bio' => 'nullable',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctors.index')
            ->with('success', 'Dokter berhasil ditambahkan');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $users = User::where('role', 'doctor')->get();
        $polis = Poli::all();

        return view('doctors.edit', compact('doctor', 'users', 'polis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'poli_id' => 'required',
            'specialization' => 'required',
            'license_number' => 'required',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());

        return redirect()->route('doctors.index')
            ->with('success', 'Dokter berhasil diperbarui');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Dokter berhasil dihapus');
    }
}
