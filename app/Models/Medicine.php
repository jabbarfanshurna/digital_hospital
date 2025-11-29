<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Pastikan baris ini ada:
use App\Models\MedicalRecord; 

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'stock',
        'expiry_date',
        'image',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    // Relasi balik ke MedicalRecord
    public function medicalRecords()
    {
        return $this->belongsToMany(MedicalRecord::class, 'medical_record_medicine')
                    ->withPivot('quantity', 'instructions');
    }
}