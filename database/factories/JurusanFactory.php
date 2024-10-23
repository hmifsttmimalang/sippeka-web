<?php

namespace Database\Factories;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

class JurusanFactory extends Factory
{
    protected $model = Jurusan::class;

    public function definition()
    {
        return [
            'nama_jurusan' => $this->faker->word(),
            'kuota' => $this->faker->numberBetween(20, 100),
            'status' => $this->faker->randomElement(['dibuka', 'ditutup']),
        ];
    }
}
