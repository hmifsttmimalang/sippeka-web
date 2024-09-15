<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skill_test_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sesi');
            $table->foreignId('skill_test_id')->constrained('skill_tests');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->enum('jenis_sesi', ['Seleksi', 'Simulasi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_test_sessions');
    }
};
