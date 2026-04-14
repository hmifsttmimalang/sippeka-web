<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\Skill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Registration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Create or retrieve a user instance
        $user = User::inRandomOrder()->first();

        // Get the username and sanitize it for file paths
        $username = $user ? $user->username : 'default_user';
        $sanitizedUsername = str_replace(['.', '/'], '_', $username); // Replace dots and slashes

        // Calculate the date range for ages 17 to 40 years old
        $startDate = Carbon::now()->subYears(40)->toDateString(); // 40 years ago from now
        $endDate = Carbon::now()->subYears(17)->toDateString(); // 17 years ago from now

        return [
            'user_id' => $user ? $user->id : User::factory(),
            'name' => $this->faker->name,
            'place_of_birth' => $this->faker->city,
            'date_of_birth' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'religion' => $this->faker->randomElement(['Islam', 'Christian', 'Catholic', 'Hindu', 'Buddhist', 'Confucian']),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'skill_id' => Skill::inRandomOrder()->first()?->id ?? Skill::factory(),
            'identity_document_path' => 'uploads/'.$sanitizedUsername.'/identity_document.jpg',
            'certificate_document_path' => 'uploads/'.$sanitizedUsername.'/certificate_document.jpg',
            'formal_photo_path' => 'uploads/'.$sanitizedUsername.'/formal_photo.jpg',
            'skill_score' => $this->faker->numberBetween(50, 100),
            'interview_score' => $this->faker->numberBetween(50, 100),
            'verification_status' => 'Pending',
        ];
    }
}
