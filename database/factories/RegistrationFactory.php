<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

        // Ensure the directory exists
        $directoryPath = public_path('storage/uploads/' . $sanitizedUsername);
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        return [
            'user_id' => $user ? $user->id : User::factory(),
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'alamat' => $this->faker->address,
            'telepon' => $this->faker->phoneNumber,
            'keahlian' => Skill::inRandomOrder()->first()->id,
            'foto_ktp' => 'uploads/' . $sanitizedUsername . '/foto_ktp.jpg',
            'foto_ijazah' => 'uploads/' . $sanitizedUsername . '/foto_ijazah.jpg',
            'foto_bg_biru' => 'uploads/' . $sanitizedUsername . '/foto_bg_biru.jpg',
            'foto_kk' => 'uploads/' . $sanitizedUsername . '/foto_kk.jpg',
            'nilai_keahlian' => $this->faker->numberBetween(50, 100),
            'nilai_wawancara' => $this->faker->numberBetween(50, 100),
        ];
    }
}
