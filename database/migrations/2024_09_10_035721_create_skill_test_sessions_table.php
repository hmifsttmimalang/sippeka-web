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
            $table->string('name');
            $table->foreignId('skill_test_id')->constrained('skill_tests');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('session_type', ['Selection', 'Simulation']);
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
