<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Relasi ke tabel polis, nullable karena Pasien/Admin tidak butuh poli
            $table->foreignId('poli_id')->nullable()->constrained('polis')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['poli_id']);
            $table->dropColumn('poli_id');
        });
    }
};