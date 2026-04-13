<?php

namespace Database\Factories;

use App\Models\SkillTest;
use App\Models\SkillTestSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SkillTestSession>
 */
class SkillTestSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SkillTestSession::class;

    public function definition()
    {
        $start_time = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $end_time = (clone $start_time)->modify('+2 hours');  // Tambahkan 2 jam ke waktu mulai

        // Buat atau ambil SkillTest secara acak
        $skillTest = SkillTest::inRandomOrder()->first() ?? SkillTest::factory()->create();

        // Pilih jenis sesi secara acak: Seleksi atau Simulasi
        $jenisSesi = $this->faker->randomElement(['Seleksi', 'Simulasi']);

        return [
            // Nama sesi berdasarkan jenis sesi dan nama tes keahlian
            'nama_sesi' => $jenisSesi . ' ' . $skillTest->nama_tes,
            'skill_test_id' => $skillTest->id,  // Foreign key ke SkillTest
            'waktu_mulai' => $start_time,  // Waktu mulai sesi
            'waktu_selesai' => $end_time,  // Waktu selesai sesi
            'jenis_sesi' => $jenisSesi,  // Jenis sesi (Seleksi atau Simulasi)
        ];
    }
}
