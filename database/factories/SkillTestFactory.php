<?php

namespace Database\Factories;

use App\Models\QuestionTitle;
use App\Models\Skill;
use App\Models\SkillTest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SkillTest>
 */
class SkillTestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SkillTest::class;

    public function definition()
    {
        // Dapatkan data mata soal dan keahlian secara acak
        $mataSoal = QuestionTitle::inRandomOrder()->first();
        $keahlian = Skill::inRandomOrder()->first();

        return [
            'nama_tes' => $keahlian->nama,  // Nama tes berdasarkan keahlian
            'mata_soal' => $mataSoal->id,  // Foreign key ke QuestionTitle
            'keahlian' => $keahlian->id,   // Foreign key ke Skill
            'acak_soal' => $this->faker->randomElement(['y', 't']),  // Acak soal
            'acak_jawaban' => $this->faker->randomElement(['y', 't']),  // Acak jawaban
            'durasi_menit' => 90,  // Durasi tetap
        ];
    }
}
