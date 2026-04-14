<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    public function run()
    {
        Major::factory()->count(6)->create(); // Create 6 majors
    }
}
