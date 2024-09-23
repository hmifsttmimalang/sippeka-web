<?php

namespace Tests\Feature;

use App\Models\Registration;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_access_registration_form()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->get('/pendaftaran');
        $response->assertStatus(200);
        $response->assertViewIs('pendaftaran.form_registrasi');
    }

    /** @test */
    public function registration_requires_valid_data()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->post('/pendaftaran', [
            'nama' => '',
            'tempat_lahir' => '',
            'tanggal_lahir' => 'invalid-date',
            'jenis_kelamin' => '',
            'agama' => '',
            'alamat' => '',
            'telepon' => '',
            'keahlian' => '',
            'foto_ktp' => '',
            'foto_ijazah' => '',
            'foto_bg_biru' => '',
            'foto_kk' => '',
        ]);

        $response->assertSessionHasErrors([
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'alamat',
            'telepon',
            'keahlian',
            'foto_ktp',
            'foto_ijazah',
            'foto_bg_biru',
            'foto_kk',
        ]);
    }

    /** @test */
    public function user_can_successfully_register()
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'user']);
        $skill = Skill::factory()->create(); // Pastikan ada data skill

        $this->actingAs($user);

        $response = $this->post('/pendaftaran', [
            'nama' => 'John Doe',
            'tempat_lahir' => 'City',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => '123 Street',
            'telepon' => '08123456789',
            'keahlian' => $skill->id,
            'foto_ktp' => UploadedFile::fake()->image('foto_ktp.jpg'),
            'foto_ijazah' => UploadedFile::fake()->image('foto_ijazah.jpg'),
            'foto_bg_biru' => UploadedFile::fake()->image('foto_bg_biru.jpg'),
            'foto_kk' => UploadedFile::fake()->image('foto_kk.jpg'),
        ]);

        $response->assertRedirect('/pendaftaran/terkirim');
        $this->assertDatabaseHas('registrations', [
            'user_id' => $user->id,
            'nama' => 'John Doe',
            'tempat_lahir' => 'City',
        ]);
    }

    /** @test */
    public function user_is_redirected_if_already_registered()
    {
        // Pastikan ada data skill yang valid
        $skill = Skill::first(); // Ambil skill pertama

        // Jika tidak ada skill, buat skill baru
        if (!$skill) {
            $skill = Skill::create(['nama' => 'Web Developer']);
        }

        $user = User::factory()->create(['role' => 'user']);

        // Simulasi pendaftaran sudah ada
        Registration::create([
            'user_id' => $user->id,
            'nama' => 'John Doe',
            'tempat_lahir' => 'City',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => '123 Street',
            'telepon' => '08123456789',
            'keahlian' => $skill->id, // Gunakan ID skill yang valid
            'foto_ktp' => 'path/to/foto_ktp.jpg', // Simulasi path file
            'foto_ijazah' => 'path/to/foto_ijazah.jpg',
            'foto_bg_biru' => 'path/to/foto_bg_biru.jpg',
            'foto_kk' => 'path/to/foto_kk.jpg',
        ]);

        $this->actingAs($user);

        $response = $this->get('/pendaftaran');
        $response->assertRedirect('/pendaftaran/terdaftar');
    }
}
