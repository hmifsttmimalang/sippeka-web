<?php

namespace Database\Seeders;

use App\Models\TestAttempt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestAttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestAttempt::factory()->count(10)->create();
    }
}
