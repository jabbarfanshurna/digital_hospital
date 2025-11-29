<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    public function run(): void
    {
        $completedApps = Appointment::where('status', 'completed')->get();
        $medicines = Medicine::all();

        foreach ($completedApps as $app) {
            $record = MedicalRecord::create([
                'appointment_id' => $app->id,
                'patient_id' => $app->patient_id,
                'doctor_id' => $app->doctor_id,
                'diagnosis' => 'Infeksi Saluran Pernapasan Akut (ISPA)',
                'treatment' => 'Istirahat total dan perbanyak minum air putih.',
                'notes' => 'Jika demam tidak turun dalam 3 hari, segera kembali.',
            ]);

            // Resep Obat
            if ($medicines->count() >= 2) {
                $record->medicines()->attach([
                    $medicines[0]->id => ['quantity' => 10, 'instructions' => '3x1 Sesudah makan'], // Paracetamol
                    $medicines[2]->id => ['quantity' => 5, 'instructions' => '1x1 Pagi hari'], // Vit C
                ]);
            }
        }
    }
}