<?php

namespace Tests\Feature;

use App\Models\JadwalTes;
use App\Models\Jurusan;
use App\Models\Pengumuman;
use App\Models\Registration;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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

    /** @test */
    public function test_info_pelatihan_displays_jadwal_and_jurusan()
    {
        // Buat data dummy untuk jurusan dan jadwal tes
        Jurusan::factory()->count(5)->create();
        JadwalTes::factory()->count(10)->create();

        // Login sebagai pengguna
        $user = User::factory()->create();
        Auth::login($user);

        // Akses halaman informasi pelatihan
        $response = $this->get('/info-pelatihan');

        // Memastikan status 200 dan halaman informasi pelatihan ditampilkan
        $response->assertStatus(200);
        $response->assertViewIs('informasi_pelatihan');

        // Memastikan variabel 'jurusan', 'jadwalTes', dan 'statusList' dikirim ke view
        $response->assertViewHas('jurusan', function ($value) {
            return $value instanceof \Illuminate\Pagination\LengthAwarePaginator;
        });

        $response->assertViewHas('jadwalTes', function ($value) {
            return $value instanceof \Illuminate\Pagination\LengthAwarePaginator;
        });

        // Memastikan status list tersedia di view
        $response->assertViewHas('statusList', [
            'dibuka' => 'Dibuka',
            'ditutup' => 'Ditutup',
        ]);
    }

    /** @test */
    public function it_displays_latest_pengumuman_and_calculated_scores()
    {
        // Setup data pengumuman
        $pengumuman = Pengumuman::factory()->create([
            'tanggal_waktu' => now()->addDays(1),
        ]);

        // Setup skill dan registrasi
        $skill = Skill::factory()->create(['nama' => 'Programming']);

        $registration1 = Registration::factory()->create([
            'keahlian' => $skill->id,
            'nilai_keahlian' => 80,
            'nilai_wawancara' => 90,
        ]);

        $registration2 = Registration::factory()->create([
            'keahlian' => $skill->id,
            'nilai_keahlian' => 70,
            'nilai_wawancara' => null,
        ]);

        // Expected rata-rata untuk pendaftar pertama
        $expectedRataRata = ($registration1->nilai_keahlian + $registration1->nilai_wawancara) / 2;

        // Panggil endpoint yang diuji
        $response = $this->get(route('hasil-pengumuman'));

        // Pastikan status dan view yang digunakan benar
        $response->assertStatus(200);
        $response->assertViewIs('pengumuman_hasil_seleksi');

        // Pastikan pengumuman waktu sudah benar
        $response->assertViewHas('pengumumanWaktu', $pengumuman->tanggal_waktu);

        // Ambil data yang diteruskan ke view
        $listPendaftar = $response->viewData('listPendaftar');

        // Cek data pendaftar pertama
        $firstPendaftar = $listPendaftar->first();
        $this->assertEquals($expectedRataRata, $firstPendaftar->rata_rata);

        // Pastikan pendaftar kedua memiliki nilai wawancara null
        $lastPendaftar = $listPendaftar->last();
        $this->assertNull($lastPendaftar->rata_rata);

        // Pengecekan paginasi (pastikan $listPendaftar benar-benar menggunakan paginasi)
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $listPendaftar);
        $this->assertEquals(2, $listPendaftar->total()); // Sesuaikan dengan jumlah data yang ada
    }
}
