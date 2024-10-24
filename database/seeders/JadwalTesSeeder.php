<?php

namespace Database\Seeders;

use App\Models\JadwalTes;
use Illuminate\Database\Seeder;

class JadwalTesSeeder extends Seeder
{
    public function run()
    {
        JadwalTes::factory()->count(6)->create(); // Membuat 6 jadwal tes
    }
}
