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
        // Membuat beberapa user menggunakan factory
        User::factory(30)->create();

        // Membuat satu user tertentu jika diperlukan
        User::create([
            'username' => 'admin',
            'email' => 'admin@sippeka.org',
            'password' => Hash::make('admin123'), // Hash password untuk keamanan
            'role' => 'admin',
            'status_register' => 'tidak terdaftar',
        ]);
    }
}
