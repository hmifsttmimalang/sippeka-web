<?php

namespace Database\Factories;

use App\Models\Pengumuman;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PengumumanFactory extends Factory
{
    protected $model = Pengumuman::class;

    public function definition(): array
    {
        return [
            'tanggal_waktu' => Carbon::now()->addDays($this->faker->numberBetween(1, 30))
                ->setTime($this->faker->numberBetween(0, 23), $this->faker->numberBetween(0, 59)),
        ];
    }
}
