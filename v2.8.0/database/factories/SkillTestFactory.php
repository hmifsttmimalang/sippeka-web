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
        do {
            // Dapatkan data mata soal dan keahlian secara acak
            $mataSoal = QuestionTitle::inRandomOrder()->first();
            $keahlian = Skill::inRandomOrder()->first();

            // Periksa apakah kombinasi sudah ada
            $exists = SkillTest::where('mata_soal', $mataSoal->id)
                ->where('keahlian', $keahlian->id)
                ->exists();
        } while ($exists); // Ulangi sampai menemukan kombinasi yang belum ada

        return [
            'nama_tes' => $this->faker->sentence(3),  // Nama tes acak
            'mata_soal' => $mataSoal->id,  // Foreign key ke QuestionTitle
            'keahlian' => $keahlian->id,   // Foreign key ke Skill
            'acak_soal' => $this->faker->randomElement(['y', 't']),  // Acak soal
            'acak_jawaban' => $this->faker->randomElement(['y', 't']),  // Acak jawaban
            'durasi_menit' => $this->faker->numberBetween(30, 120),  // Durasi acak
        ];
    }
}
