<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
   public function index(Request $request)
{
    $query = Medicine::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->has('status') && $request->status != '') {
        if ($request->status == 'available') {
            $query->where('stock', '>', 0)->whereDate('expiry_date', '>', now());
        } elseif ($request->status == 'out_of_stock') {
            $query->where('stock', '<=', 0);
        } elseif ($request->status == 'expired') { 
            $query->whereDate('expiry_date', '<=', now());
        }
    }

    $medicines = $query->latest()->get();
    return view('dashboard.admin.medicines.index', compact('medicines'));
}

    public function create()
    {
        return view('dashboard.admin.medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:keras,biasa',
            'stock' => 'required|integer|min:0',
            'expiry_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('medicines', 'public');
        }

        Medicine::create($data);

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine created successfully.');
    }

    public function edit(Medicine $medicine)
    {
        return view('dashboard.admin.medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:keras,biasa',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($medicine->image) {
                Storage::disk('public')->delete($medicine->image);
            }
            $data['image'] = $request->file('image')->store('medicines', 'public');
        }

        $medicine->update($data);

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        if ($medicine->image) {
            Storage::disk('public')->delete($medicine->image);
        }
        $medicine->delete();
        return redirect()->route('admin.medicines.index')->with('success', 'Medicine deleted successfully.');
    }
}