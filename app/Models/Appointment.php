<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'schedule_id',
        'booking_date',
        'complaint',
        'status',
        'admin_note',
    ];

    // Relasi ke Pasien
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    // Relasi ke Dokter
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Relasi ke Jadwal
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}