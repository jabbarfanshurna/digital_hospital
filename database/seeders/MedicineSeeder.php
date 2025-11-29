<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('medicines');

        $medicines = [
            [
                'name' => 'Paracetamol 500mg', 
                'type' => 'biasa', 
                'stock' => 150, 
                'description' => 'Obat analgesik dan antipiretik untuk meredakan sakit kepala dan demam.',
                // Gambar: Pills
                'img_url' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Amoxicillin 500mg', 
                'type' => 'keras', 
                'stock' => 50, 
                'description' => 'Antibiotik penisilin untuk mengobati berbagai infeksi bakteri.',
                // Gambar: Capsules
                'img_url' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Vitamin C 1000mg', 
                'type' => 'biasa', 
                'stock' => 200, 
                'description' => 'Suplemen untuk menjaga daya tahan tubuh dan kesehatan kulit.',
                // Gambar: Orange/Vitamin
                'img_url' => 'https://images.unsplash.com/photo-1512069772995-ec65ed45afd6?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Ibuprofen 400mg', 
                'type' => 'keras', 
                'stock' => 80, 
                'description' => 'Obat anti-inflamasi non-steroid (OAINS) pereda nyeri.',
                // Gambar: Blister Pack
                'img_url' => 'https://images.unsplash.com/photo-1626074353765-517a681e40be?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Sirup Obat Batuk', 
                'type' => 'biasa', 
                'stock' => 45, 
                'description' => 'Meredakan batuk berdahak dan tenggorokan gatal.',
                // Gambar: Syrup Bottle
                'img_url' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?q=80&w=800&auto=format&fit=crop'
            ],
        ];

        foreach ($medicines as $data) {
            $imagePath = null;

            try {
                $contents = file_get_contents($data['img_url']);
                if ($contents) {
                    $filename = 'medicines/' . Str::slug($data['name']) . '.jpg';
                    Storage::disk('public')->put($filename, $contents);
                    $imagePath = $filename;
                }
            } catch (\Exception $e) {
                // Fallback jika download gagal
            }

            Medicine::create([
                'name' => $data['name'],
                'type' => $data['type'],
                'stock' => $data['stock'],
                'description' => $data['description'],
                'expiry_date' => Carbon::now()->addYears(rand(1, 3)),
                'image' => $imagePath,
            ]);
        }
    }
}   