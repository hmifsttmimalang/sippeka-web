<?php

namespace Database\Seeders;

use App\Models\QuestionTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuestionTitle::factory()->count(10)->create(); // Adjust the count as needed
    }
}
