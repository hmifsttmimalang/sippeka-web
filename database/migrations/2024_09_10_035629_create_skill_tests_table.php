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
        Schema::create('skill_tests', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tes');
            $table->foreignId('mata_soal')->constrained('question_titles');
            $table->foreignId('keahlian')->constrained('skills');
            $table->enum('acak_soal', ['y', 't']);
            $table->enum('acak_jawaban', ['y', 't']);
            $table->integer('durasi_menit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_tests');
    }
};
