<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',      // Pastikan 'role' ada di fillable
        'poli_id',   // Tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: User (Dokter) milik satu Poli
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    // Relasi: User (Dokter) punya banyak Jadwal
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}