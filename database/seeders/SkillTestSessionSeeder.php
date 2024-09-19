<?php

namespace Database\Seeders;

use App\Models\SkillTestSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillTestSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SkillTestSession::factory()->count(10)->create();
    }
}
