<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = User::where('role', 'manager')->get();

        foreach ($doctors as $doctor) {
            // Buat jadwal acak untuk setiap dokter (Senin, Rabu, Jumat)
            $days = ['Senin', 'Rabu', 'Jumat'];
            
            foreach ($days as $day) {
                Schedule::create([
                    'user_id' => $doctor->id,
                    'day' => $day,
                    'start_time' => '09:00',
                    'end_time' => '09:30',
                ]);
                Schedule::create([
                    'user_id' => $doctor->id,
                    'day' => $day,
                    'start_time' => '09:30',
                    'end_time' => '10:00',
                ]);
                Schedule::create([
                    'user_id' => $doctor->id,
                    'day' => $day,
                    'start_time' => '10:00',
                    'end_time' => '10:30',
                ]);
            }
        }
    }
}