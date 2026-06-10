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
        $this->call(MajorSeeder::class);
        $this->call(TestScheduleSeeder::class);
        $this->call(AnnouncementSeeder::class);
    }
}
