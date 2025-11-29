<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'patient_id',
        'doctor_id',
        'diagnosis',
        'treatment',
        'notes',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Relasi Many-to-Many ke Obat dengan data tambahan (quantity, instructions)
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'medical_record_medicine')
                    ->withPivot('quantity', 'instructions')
                    ->withTimestamps();
    }
}