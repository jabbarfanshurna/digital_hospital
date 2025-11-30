<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',      // Pastikan 'role' ada
        'poli_id',   // Pastikan 'poli_id' ada
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi (Relationships)
    |--------------------------------------------------------------------------
    */

    // Relasi ke Poli (Khusus Dokter)
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    // Relasi ke Jadwal (Khusus Dokter)
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // Relasi ke Appointment sebagai DOKTER (appointments yang ditangani dokter ini)
    // Ini yang dicari oleh HomeController saat menghitung 'topDoctors'
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    // Relasi ke Appointment sebagai PASIEN (appointments yang dibuat pasien ini)
    // Berguna jika nanti kita butuh query dari sisi pasien
    public function patientAppointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    // Relasi ke Feedback (Ulasan yang dibuat user ini)
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}