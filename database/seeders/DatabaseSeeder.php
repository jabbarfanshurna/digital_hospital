<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PoliSeeder::class,          // 1. Poli dulu (Master Data)
            MedicineSeeder::class,      // 2. Obat (Master Data)
            UserSeeder::class,          // 3. User (Admin, Dokter, Pasien)
            ScheduleSeeder::class,      // 4. Jadwal Dokter
            AppointmentSeeder::class,   // 5. Janji Temu (Butuh User & Jadwal)
            MedicalRecordSeeder::class, // 6. Rekam Medis (Butuh Appointment & Obat)
            FeedbackSeeder::class,      // 7. Ulasan (Butuh User)
        ]);
    }
}