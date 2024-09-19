<?php

namespace Tests\Feature;

use App\Models\Registration;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_is_redirected_if_not_registered()
    {
        $user = User::factory()->create(['username' => 'john_doe']);

        // User belum terdaftar di tabel Registration
        $this->actingAs($user);

        $response = $this->get('/john_doe');

        $response->assertRedirect('/pendaftaran');
        $response->assertSessionHas('warning', 'Anda belum terdaftar. Silakan daftar terlebih dahulu');
    }

    public function user_sees_profile_if_registered()
    {
        $user = User::factory()->create(['username' => 'john_doe']);
        $registration = Registration::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get('/john_doe');

        $response->assertStatus(200);
        $response->assertViewIs('user.dashboard_user');
        $response->assertViewHas('user', $user);
        $response->assertViewHas('pendaftar', $registration);
    }

    /** @test */
    public function form_tes_seleksi_shows_for_registered_user()
    {
        // Ensure there is at least one skill in the database
        $skill = Skill::first();
        if (!$skill) {
            $skill = Skill::create(['nama' => 'Web Developer']);
        }

        // Create a user with a unique username
        $user = User::factory()->create(['username' => 'john_doe']);

        // Create a registration for the user with a valid skill ID
        $registration = Registration::factory()->create([
            'user_id' => $user->id,
            'keahlian' => $skill->id, // Use the skill ID here
        ]);

        $this->actingAs($user);

        $response = $this->get('/john_doe/seleksi-login');

        $response->assertStatus(200);
        $response->assertViewIs('user.auth_tes_seleksi');
        $response->assertViewHas('user', $user);
        $response->assertViewHas('pendaftar', $registration);
    }

    /** @test */
    public function edit_profil_shows_for_registered_user()
    {
        // Ensure there is at least one skill in the database
        $skill = Skill::first();
        if (!$skill) {
            $skill = Skill::create(['nama' => 'Web Developer']);
        }

        $user = User::factory()->create(['username' => 'john_doe']);
        $registration = Registration::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get('/john_doe/edit-profil');

        $response->assertStatus(200);
        $response->assertViewIs('user.edit_profil');
        $response->assertViewHas('user', $user);
        $response->assertViewHas('pendaftar', $registration);
    }

    /** @test */
    public function update_profil_successfully()
    {
        // Ensure skills exist
        $skill = Skill::first();
        if (!$skill) {
            $skill = Skill::create(['nama' => 'Web Developer']);
        }

        // Create user and registration with valid skill
        $user = User::factory()->create(['username' => 'john_doe', 'email' => 'oldemail@example.com']);
        $registration = Registration::factory()->create([
            'user_id' => $user->id,
            'keahlian' => $skill->id // Use the valid skill ID
        ]);

        $this->actingAs($user);

        $response = $this->post(route('user.update_profil', ['username' => 'john_doe']), [
            'nama' => 'John Doe Updated',
            'tempat_lahir' => 'City Updated',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'alamat' => '123 Street Updated',
            'telepon' => '08123456789',
            'email' => 'newemail@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertRedirect('/john_doe');
        $response->assertSessionHas('success', 'Profil berhasil diperbarui!');

        $user->refresh(); // Refresh to get updated data
        $this->assertEquals('newemail@example.com', $user->email);
        $this->assertTrue(Hash::check('newpassword', $user->password));

        $registration->refresh(); // Refresh to get updated data
        $this->assertEquals('John Doe Updated', $registration->nama);
        $this->assertEquals('City Updated', $registration->tempat_lahir);
        // Add more assertions as needed
    }
}
