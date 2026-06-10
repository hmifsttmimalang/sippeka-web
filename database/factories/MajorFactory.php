<?php

namespace Database\Factories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

class MajorFactory extends Factory
{
    protected $model = Major::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'quota' => $this->faker->numberBetween(10, 50),
            'status' => $this->faker->randomElement(['Open', 'Closed']),
        ];
    }
}
