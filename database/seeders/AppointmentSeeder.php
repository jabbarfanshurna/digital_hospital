<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $patient = User::where('role', 'user')->first();
        $doctors = User::where('role', 'manager')->with('schedules')->get();

        if (!$patient || $doctors->isEmpty()) return;

        // 1. Appointment Completed (Poli Umum)
        $doc1 = $doctors->first();
        $sch1 = $doc1->schedules->first();
        if ($sch1) {
            Appointment::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doc1->id,
                'schedule_id' => $sch1->id,
                'booking_date' => Carbon::now()->subDays(3), // 3 hari lalu
                'complaint' => 'Demam tinggi dan sakit kepala.',
                'status' => 'completed',
            ]);
        }

        // 2. Appointment Pending (Poli Gigi)
        $doc2 = $doctors->count() > 1 ? $doctors[1] : $doc1;
        $sch2 = $doc2->schedules->first();
        if ($sch2) {
            Appointment::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doc2->id,
                'schedule_id' => $sch2->id,
                'booking_date' => Carbon::now()->addDays(2), // 2 hari lagi
                'complaint' => 'Gigi geraham sakit saat makan.',
                'status' => 'pending',
            ]);
        }
    }
}