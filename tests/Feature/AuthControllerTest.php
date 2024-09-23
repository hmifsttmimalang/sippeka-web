<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_user_can_register()
    {
        $response = $this->post('/register', [
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => true, // Pastikan menyertakan checkbox untuk persetujuan
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'username' => 'testuser',
            'email' => 'testuser@example.com',
        ]);
    }

    /** @test */
    public function registration_requires_valid_data()
    {
        $response = $this->post('/register', [
            'username' => '',
            'email' => 'invalid-email',
            'password' => '123',
            'password_confirmation' => '1234',
        ]);

        $response->assertSessionHasErrors(['username', 'email', 'password']);
    }

    /** @test */
    public function an_user_can_login()
    {
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

        $response = $this->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
