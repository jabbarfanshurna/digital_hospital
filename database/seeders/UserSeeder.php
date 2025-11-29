<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Poli;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Dokter (Manager) - Assign ke Poli yang baru dibuat
        $poliUmum = Poli::where('name', 'Poli Umum')->first();
        $poliGigi = Poli::where('name', 'Poli Gigi')->first();
        $poliAnak = Poli::where('name', 'Poli Anak')->first();
        $poliJantung = Poli::where('name', 'Poli Jantung')->first();

        $doctors = [
            ['name' => 'dr. Budi Santoso', 'email' => 'dokter@example.com', 'poli' => $poliUmum],
            ['name' => 'drg. Siti Aminah', 'email' => 'siti@hospital.com', 'poli' => $poliGigi],
            ['name' => 'dr. Andi Wijaya, Sp.A', 'email' => 'andi@hospital.com', 'poli' => $poliAnak],
            ['name' => 'dr. Rina Hartati, Sp.JP', 'email' => 'rina@hospital.com', 'poli' => $poliJantung],
        ];

        foreach ($doctors as $doc) {
            if ($doc['poli']) {
                User::create([
                    'name' => $doc['name'],
                    'email' => $doc['email'],
                    'password' => Hash::make('password'),
                    'role' => 'manager',
                    'poli_id' => $doc['poli']->id,
                ]);
            }
        }

        // 3. Pasien (User)
        $patients = [
            'pasien@example.com' => 'Citra Kirana',
            'budi@gmail.com' => 'Budi Sudarsono',
            'dewi@yahoo.com' => 'Dewi Persik',
        ];

        foreach ($patients as $email => $name) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }
    }
}