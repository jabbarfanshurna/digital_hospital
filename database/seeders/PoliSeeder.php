<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan folder penyimpanan ada
        Storage::disk('public')->makeDirectory('polis');

        $polis = [
            [
                'name' => 'Poli Umum', 
                'description' => 'Layanan kesehatan primer untuk diagnosa dan pengobatan penyakit umum dewasa dan lansia.',
                // Gambar: Doctor/Stethoscope
                'img_url' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Poli Gigi', 
                'description' => 'Perawatan kesehatan gigi dan mulut, mulai dari pembersihan karang hingga bedah mulut.',
                // Gambar: Dentist
                'img_url' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Poli Anak', 
                'description' => 'Spesialisasi kesehatan bayi, anak, dan remaja dengan pendekatan yang ramah anak.',
                // Gambar: Pediatric/Kids
                'img_url' => 'https://images.unsplash.com/photo-1606092195730-5d7b9af1ef4d?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Poli Kandungan (Obgyn)', 
                'description' => 'Layanan kesehatan reproduksi wanita, kehamilan, dan persalinan.',
                // Gambar: Pregnant/Baby
                'img_url' => 'https://images.unsplash.com/photo-1537673156864-5d2572d0b28f?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Poli Jantung', 
                'description' => 'Diagnosis dan perawatan penyakit jantung dan pembuluh darah dengan teknologi terkini.',
                // Gambar: Heart/Cardio
                'img_url' => 'https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?q=80&w=800&auto=format&fit=crop'
            ],
        ];

        foreach ($polis as $data) {
            $imagePath = null;

            // Logika Download Gambar
            try {
                $contents = file_get_contents($data['img_url']);
                if ($contents) {
                    $filename = 'polis/' . Str::slug($data['name']) . '.jpg';
                    Storage::disk('public')->put($filename, $contents);
                    $imagePath = $filename;
                }
            } catch (\Exception $e) {
                // Jika gagal download (misal internet mati), biarkan null
                // View kita sudah punya fallback icon yang bagus
            }

            Poli::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'image' => $imagePath,
            ]);
        }
    }
}