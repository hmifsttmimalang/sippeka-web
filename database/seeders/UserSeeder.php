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
        // Create specific users
        User::create([
            'username' => 'admin',
            'email' => 'admin@sippeka.org',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'registration_status' => 'unregistered',
        ]);

        User::create([
            'username' => 'pelatih',
            'email' => 'pelatih@sippeka.org',
            'password' => Hash::make('pelatih123'),
            'role' => 'instructor',
            'registration_status' => 'unregistered',
        ]);

        User::create([
            'username' => 'peserta',
            'email' => 'peserta@sippeka.org',
            'password' => Hash::make('peserta123'),
            'role' => 'user',
            'registration_status' => 'unregistered',
        ]);
    }
}
