<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    // Tampilkan semua Poli
    public function index()
    {
        $polis = Poli::all();
        return view('polis.index', compact('polis'));
    }

    // Form tambah poli
    public function create()
    {
        return view('polis.create');
    }

    // Simpan poli baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'icon' => 'nullable',
        ]);

        Poli::create($request->all());

        return redirect()->route('polis.index')->with('success', 'Poli berhasil ditambahkan');
    }

    // Form edit poli
    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('polis.edit', compact('poli'));
    }

    // Update poli
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($request->all());

        return redirect()->route('polis.index')->with('success', 'Poli berhasil diperbarui');
    }

    // Hapus poli
    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();
        return redirect()->route('polis.index')->with('success', 'Poli berhasil dihapus');
    }
}
