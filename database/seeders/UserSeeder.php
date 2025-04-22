<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat satu user tertentu jika diperlukan
        User::create([
            'username' => 'admin',
            'email' => 'admin@sippeka.org',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status_register' => 'tidak terdaftar',
        ]);

        User::create([
            'username' => 'pelatih',
            'email' => 'pelatih@sippeka.org',
            'password' => Hash::make('pelatih123'),
            'role' => 'instruktur',
            'status_register' => 'tidak terdaftar',
        ]);
    }
}
