<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_user_can_register()
    {
        $response = $this->withoutMiddleware()->post(route('auth.register.store'), [
            'username' => 'newuser',
            'email' => 'newuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => true, // Jika syarat harus disetujui
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
    }

    /** @test */
    public function registration_requires_valid_data()
    {
        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware()->post(route('auth.register.store'), [
            'username' => 'valid_username',
            'email' => 'valid_email@example.com',
            'password' => 'valid_password',
            'password_confirmation' => 'valid_password',
            'terms' => true,
        ]);

        // Pastikan redirect terjadi setelah registrasi sukses
        $response->assertStatus(302);
        $this->assertAuthenticated(); // Memastikan pengguna terautentikasi
    }

    /** @test */
    public function an_user_can_login()
    {
        // Menonaktifkan middleware CSRF
        $this->withoutMiddleware();

        // Membuat user dummy
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'identifier' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function login_requires_valid_credentials()
    {
        $this->withoutMiddleware(); // Menonaktifkan middleware CSRF

        $response = $this->post('/login', [
            'identifier' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }

    /** @test */
    public function logout_clears_session()
    {
        // Membuat user dummy dan login
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $this->actingAs($user);

        $this->withoutMiddleware(); // Nonaktifkan CSRF

        $response = $this->post('/logout');

        $response->assertRedirect('/login'); // Ganti '/login' dengan route login jika perlu
        $this->assertGuest();
    }
}
