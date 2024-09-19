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
        $this->call(RegistrationSeeder::class);
        $this->call(QuestionTitleSeeder::class);
        $this->call(SkillTestSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(SkillTestSessionSeeder::class);
        $this->call(TestAttemptSeeder::class);
    }
}
