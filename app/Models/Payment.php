<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'medical_record_id',
        'biaya_konsultasi',
        'biaya_tindakan',
        'biaya_obat',
        'total_biaya',
        'status',
    ];

    public function record()
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id');
    }
}

