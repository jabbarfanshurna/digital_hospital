<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_record_medicine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained()->onDelete('cascade');
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
            $table->integer('quantity'); // Jumlah obat yang diresepkan
            $table->text('instructions')->nullable(); // Aturan pakai (e.g., 3x1 sesudah makan)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_record_medicine');
    }
};