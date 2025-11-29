<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Fitur filter role sesuai requirement layout point 4
        $query = User::query();
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }
        $users = $query->latest()->get();
        return view('dashboard.admin.users.index', compact('users'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('dashboard.admin.users.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,manager,user'], // manager = dokter, user = pasien
            'poli_id' => ['nullable', 'exists:polis,id'],
        ]);

        // Validasi tambahan: Jika role manager (dokter), poli wajib diisi
        if ($request->role === 'manager' && !$request->poli_id) {
            return back()->withErrors(['poli_id' => 'Doctor must be assigned to a Poli.'])->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'poli_id' => $request->role === 'manager' ? $request->poli_id : null,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $polis = Poli::all();
        return view('dashboard.admin.users.edit', compact('user', 'polis'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'in:admin,manager,user'],
            'poli_id' => ['nullable', 'exists:polis,id'],
        ]);

        if ($request->role === 'manager' && !$request->poli_id) {
            return back()->withErrors(['poli_id' => 'Doctor must be assigned to a Poli.'])->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'poli_id' => $request->role === 'manager' ? $request->poli_id : null,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot delete yourself.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}