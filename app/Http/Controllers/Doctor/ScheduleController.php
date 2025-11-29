<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('user_id', Auth::id())
            ->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('start_time')
            ->get();
            
        return view('dashboard.manager.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('dashboard.manager.schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
        ]);

        $startTime = Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = $startTime->copy()->addMinutes(30); // Requirement: Durasi harus 30 menit

        // Validasi Tumpang Tindih (Overlap)
        $overlap = Schedule::where('user_id', Auth::id())
            ->where('day', $request->day)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime->format('H:i'), $endTime->format('H:i')])
                      ->orWhereBetween('end_time', [$startTime->format('H:i'), $endTime->format('H:i')])
                      ->orWhere(function ($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<', $startTime->format('H:i'))
                            ->where('end_time', '>', $endTime->format('H:i'));
                      });
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['start_time' => 'Jadwal bertabrakan dengan jadwal lain.'])->withInput();
        }

        Schedule::create([
            'user_id' => Auth::id(),
            'day' => $request->day,
            'start_time' => $startTime->format('H:i'),
            'end_time' => $endTime->format('H:i'),
        ]);

        return redirect()->route('doctor.schedules.index')->with('success', 'Schedule added successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        // Pastikan dokter hanya menghapus jadwal miliknya
        if ($schedule->user_id !== Auth::id()) {
            abort(403);
        }
        
        $schedule->delete();
        return redirect()->route('doctor.schedules.index')->with('success', 'Schedule deleted.');
    }
}