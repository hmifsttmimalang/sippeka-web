<?php

namespace Database\Factories;

use App\Models\JadwalTes;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalTesFactory extends Factory
{
    protected $model = JadwalTes::class;

    public function definition()
    {
        return [
            'jurusan_id' => Jurusan::factory(), // Menggunakan factory Jurusan
            'tanggal_pelaksanaan' => $this->faker->date(),
            'waktu_pelaksanaan' => $this->faker->time(),
        ];
    }
}
