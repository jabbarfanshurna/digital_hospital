<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('dashboard.admin.polis.index', compact('polis'));
    }

    public function create()
    {
        return view('dashboard.admin.polis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:polis,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('polis', 'public');
        }

        Poli::create($data);

        return redirect()->route('admin.polis.index')->with('success', 'Poli created successfully.');
    }

    public function edit(Poli $poli)
    {
        return view('dashboard.admin.polis.edit', compact('poli'));
    }

    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'name' => 'required|unique:polis,name,' . $poli->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($poli->image) {
                Storage::disk('public')->delete($poli->image);
            }
            $data['image'] = $request->file('image')->store('polis', 'public');
        }

        $poli->update($data);

        return redirect()->route('admin.polis.index')->with('success', 'Poli updated successfully.');
    }

    public function destroy(Poli $poli)
    {
        if ($poli->image) {
            Storage::disk('public')->delete($poli->image);
        }
        $poli->delete();
        return redirect()->route('admin.polis.index')->with('success', 'Poli deleted successfully.');
    }
}