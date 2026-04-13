<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $domains = ['sigma.com', 'skibidi.com', 'mewing.com', 'sus.com'];
    
        // Buat username terlebih dahulu
        $username = $this->faker->unique()->userName;
    
        return [
            'username' => $username, // Setel username
            'email' => $username . '@' . $this->faker->randomElement($domains), // Gunakan username yang sama untuk email
            'password' => Hash::make('password'), // password default "password"
            'role' => 'user',
            'status_register' => 'terdaftar',
            'remember_token' => Str::random(10),
        ];
    }    

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
