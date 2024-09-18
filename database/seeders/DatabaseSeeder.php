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
        // Menjalankan seeder user
        $this->call(UserSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(RegistrationSeeder::class);
    }
}
