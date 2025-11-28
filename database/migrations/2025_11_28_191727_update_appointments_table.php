<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Tambah poli_id (relasi ke tabel polis)
            if (!Schema::hasColumn('appointments', 'poli_id')) {
                $table->foreignId('poli_id')->nullable()->after('doctor_id')
                    ->constrained()->onDelete('cascade');
            }

            // Tambah status
            if (!Schema::hasColumn('appointments', 'status')) {
                $table->string('status')->default('pending')->after('keluhan');
            }

            // Tambah jam_mulai & jam_selesai
            if (!Schema::hasColumn('appointments', 'jam_mulai')) {
                $table->time('jam_mulai')->nullable()->after('jam');
            }

            if (!Schema::hasColumn('appointments', 'jam_selesai')) {
                $table->time('jam_selesai')->nullable()->after('jam_mulai');
            }
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['poli_id', 'status', 'jam_mulai', 'jam_selesai']);
        });
    }
};
