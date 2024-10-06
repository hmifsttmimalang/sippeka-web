<?php

namespace Tests\Feature;

use Carbon\Carbon;
use App\Models\Question;
use App\Models\QuestionTitle;
use App\Models\Registration;
use App\Models\Skill;
use App\Models\SkillTest;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SelectionTestControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_index_with_active_session()
    {
        // Atur waktu saat ini untuk testing
        Carbon::setTestNow(Carbon::create(2023, 10, 6, 10, 0, 0, 'Asia/Jakarta'));

        // Pastikan ada setidaknya satu skill di database
        $skill = Skill::first() ?: Skill::create(['nama' => 'Web Developer']);

        // Pastikan ada setidaknya satu mata soal di database
        $mataSoal = QuestionTitle::first() ?: QuestionTitle::create(['nama' => 'Mata Soal']);

        // Buat data yang diperlukan
        $user = User::factory()->create(['username' => 'john_doe']);
        Registration::factory()->create([
            'user_id' => $user->id,
            'keahlian' => $skill->id,
            'nilai_keahlian' => null // Pastikan nilai ini adalah null
        ]);

        // Buat skill test dan pertanyaan
        $skillTest = SkillTest::factory()->create([
            'mata_soal' => $mataSoal->id,
            'keahlian' => $skill->id
        ]);
        Question::factory()->create(['skill_test_id' => $skillTest->id, 'jawaban_benar' => 'A']);

        // Buat sesi seleksi aktif
        SkillTestSession::factory()->create([
            'jenis_sesi' => 'Seleksi',
            'waktu_mulai' => now()->subHour(), // Sesi mulai 1 jam yang lalu
            'waktu_selesai' => now()->addHour() // Sesi berakhir 1 jam ke depan
        ]);

        // Cek apakah sesi tetap aktif
        $this->actingAs($user);
        $response = $this->get(route('user.seleksi', ['username' => $user->username]));

        // Pastikan mendapatkan status 200
        $response->assertStatus(200);
        $response->assertViewIs('tes-seleksi.tes_seleksi_peserta');
        $response->assertViewHas('questions');
        $response->assertViewHas('remainingSeconds');
    }

    public function test_kirim_jawaban_seleksi_success()
    {
        // Ensure there is at least one skill in the database
        $skill = Skill::first();
        if (!$skill) {
            $skill = Skill::create(['nama' => 'Web Developer']);
        }

        $mataSoal = QuestionTitle::first();
        if (!$mataSoal) {
            $mataSoal = QuestionTitle::create(['nama' => 'Mata Soal']);
        }

        // Create necessary data
        $user = User::factory()->create(['username' => 'john_doe']);
        $registration = Registration::factory()->create([
            'user_id' => $user->id,
            'keahlian' => $skill->id
        ]);
        $sesiSeleksi = SkillTestSession::factory()->create([
            'jenis_sesi' => 'Seleksi',
            'waktu_mulai' => Carbon::now()->subHour(),
            'waktu_selesai' => Carbon::now()->addHour()
        ]);
        $skillTest = SkillTest::factory()->create();
        $question = Question::factory()->create(['skill_test_id' => $skillTest->id, 'jawaban_benar' => 'A']);

        // Create a test attempt
        TestAttempt::factory()->create([
            'registration_id' => $registration->id,
            'skill_test_session_id' => $sesiSeleksi->id,
            'status' => 'finished'
        ]);

        // Acting as the user
        $this->actingAs($user);

        // Prepare answers data
        $answers = json_encode([
            $question->id => ['A']
        ]);

        // Hit the route
        $response = $this->postJson(route('user.seleksi.store', ['username' => 'john_doe']), [
            'userAnswers' => $answers,
            'skill_test_session_id' => $sesiSeleksi->id
        ]);

        // Assert response
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Jawaban berhasil disimpan',
            'score' => 1,
            'scorePercentage' => 100
        ]);
    }

    public function test_kirim_jawaban_seleksi_validation_error()
    {
        // Acting as the user
        $user = User::factory()->create(['username' => 'john_doe']);
        $this->actingAs($user);

        // Hit the route with invalid data
        $response = $this->postJson(route('user.seleksi.store', ['username' => 'john_doe']), [
            'userAnswers' => 'invalid_json',  // Contoh data tidak valid
            'skill_test_session_id' => 1
        ]);

        // Assert validation error
        $response->assertStatus(422); // Ganti 400 dengan 422
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'userAnswers',
            ],
        ]);
    }
}
