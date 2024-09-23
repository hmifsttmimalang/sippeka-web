<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_see_home_page()
    {
        // Tamu (guest) mengakses halaman utama
        $response = $this->get('/');

        // Memastikan status 200 (berhasil) dan halaman home ditampilkan
        $response->assertStatus(200);

        // Memastikan halaman 'home' digunakan
        $response->assertViewIs('home');

        // Memastikan halaman menampilkan teks tertentu, misalnya "Selamat datang"
        $response->assertSee('Selamat datang');
    }

    /** @test */
    public function test_authenticated_user_can_see_home_view()
    {
        // Membuat user dummy
        $user = User::factory()->create();

        // Acting as: Login sebagai user tersebut
        $response = $this->actingAs($user)->get('/');

        // Memastikan halaman 'home' dipakai
        $response->assertViewIs('home');

        // Memastikan bahwa variabel 'user' dikirim ke view
        $response->assertViewHas('user', $user);

        // Memastikan halaman menampilkan nama user
        $response->assertSee($user->name);
    }

    public function test_home_view_receives_user_variable()
    {
        $user = User::factory()->make();

        $view = $this->view('home', ['user' => $user]);

        $view->assertSee($user->name);
    }
}
