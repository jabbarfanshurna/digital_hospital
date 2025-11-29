<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('users'); // Redundansi untuk query cepat
            $table->foreignId('doctor_id')->constrained('users');  // Redundansi untuk query cepat
            $table->text('diagnosis');
            $table->text('treatment'); // Tindakan medis
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};