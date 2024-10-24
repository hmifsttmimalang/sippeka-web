<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        Jurusan::factory()->count(6)->create(); // Membuat 6 jurusan
    }
}
