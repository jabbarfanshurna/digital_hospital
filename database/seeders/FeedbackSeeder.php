<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $patient = User::where('role', 'user')->first();

        if ($patient) {
            Feedback::create([
                'user_id' => $patient->id,
                'rating' => 5,
                'message' => 'Dokter sangat ramah dan penjelasannya mudah dimengerti. Fasilitas RS juga bersih.',
                'is_published' => true,
            ]);
            
            Feedback::create([
                'user_id' => $patient->id,
                'rating' => 4,
                'message' => 'Pelayanan cepat, tapi antrian obat sedikit lama.',
                'is_published' => true,
            ]);
        }
    }
}