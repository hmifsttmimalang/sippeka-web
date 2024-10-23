<?php

namespace Database\Seeders;

use App\Models\JadwalTes;
use Illuminate\Database\Seeder;

class JadwalTesSeeder extends Seeder
{
    public function run()
    {
        JadwalTes::factory()->count(20)->create(); // Membuat 20 jadwal tes
    }
}
