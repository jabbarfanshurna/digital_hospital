<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Halaman Beranda (Landing Page).
    public function index()
    {
        // Ambil 3 poli untuk ditampilkan di halaman depan sebagai highlight
        $featured_polis = Poli::limit(3)->get();
        return view('welcome', compact('featured_polis'));
    }

    // Halaman Daftar Poli.
    public function polis()
    {
        $polis = Poli::all();
        return view('public.polis', compact('polis'));
    }

    // Halaman Daftar Dokter & Jadwal.
    public function doctors()
    {
        // Ambil user dengan role 'manager' (Dokter) beserta relasi poli dan jadwalnya
        $doctors = User::where('role', 'manager')
            ->with(['poli', 'schedules' => function($query) {
                // Urutkan jadwal berdasarkan hari
                $query->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
                      ->orderBy('start_time');
            }])
            ->get();

        return view('public.doctors', compact('doctors'));
    }
}