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
            $table->string('name');
            $table->foreignId('question_title_id')->constrained('question_titles');
            $table->foreignId('skill_id')->constrained('skills');
            $table->enum('shuffle_questions', ['y', 't'])->default('t');
            $table->enum('shuffle_answers', ['y', 't'])->default('t');
            $table->integer('duration_minutes');
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
