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
        // Migration untuk tabel baru test_attempts
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registrations'); // Menghubungkan ke tabel registrations
            $table->foreignId('skill_test_session_id')->constrained('skill_test_sessions'); // Menghubungkan ke sesi tes keahlian
            $table->enum('status', ['in_progress', 'finished'])->default('in_progress'); // Status pengerjaan
            $table->timestamp('waktu_mulai')->nullable(); // Waktu mulai tes
            $table->timestamp('waktu_selesai')->nullable(); // Waktu selesai tes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};
