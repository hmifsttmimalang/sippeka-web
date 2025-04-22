<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(QuestionTitleSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(JadwalTesSeeder::class);
        $this->call(PengumumanSeeder::class);
    }
}
