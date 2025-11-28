<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained()->onDelete('cascade');
            $table->integer('biaya_konsultasi')->default(50000);
            $table->integer('biaya_tindakan')->default(0);
            $table->integer('biaya_obat')->default(0);
            $table->integer('total_biaya')->default(0);
            $table->string('status')->default('unpaid'); // unpaid / paid
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }

};
