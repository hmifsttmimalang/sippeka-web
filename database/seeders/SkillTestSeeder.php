<?php

namespace Database\Seeders;

use App\Models\SkillTest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SkillTest::factory()->count(10)->create(); // Adjust the count as needed
    }
}
