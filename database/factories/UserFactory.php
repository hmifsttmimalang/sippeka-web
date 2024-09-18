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
    
        return [
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->userName . '@' . $this->faker->randomElement($domains), // Domain acak
            'password' => Hash::make('password'), // password default "password"
            // 'role' => $this->faker->randomElement(['user', 'admin']), // ini untuk membuat semua user yang sebagiannya dapat menjadi admin
            'role' => 'user',
            'status_register' => $this->faker->randomElement(['tidak terdaftar', 'terdaftar']),
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
