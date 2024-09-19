<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\QuestionTitle;
use App\Models\Registration;
use App\Models\Skill;
use App\Models\SkillTest;
use App\Models\SkillTestSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SimulationTestControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_simulation_page_access_with_active_session()
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

        // Create user and skill test session
        $user = User::factory()->create(['username' => 'john_doe']);
        $registration = Registration::factory()->create(['user_id' => $user->id]);
        $skillTest = SkillTest::factory()->create();
        $question = Question::factory()->create(['skill_test_id' => $skillTest->id]);

        // Create a skill test session for simulation
        $simulationSession = SkillTestSession::factory()->create([
            'jenis_sesi' => 'Simulasi',
            'waktu_mulai' => now()->subMinutes(10),
            'waktu_selesai' => now()->addMinutes(10),
        ]);

        // Acting as the user
        $this->actingAs($user);

        // Hit the simulation route
        $response = $this->get(route('user.simulasi', ['username' => 'john_doe']));

        // Assert response is OK and view is rendered correctly
        $response->assertStatus(200);
        $response->assertViewIs('tes-seleksi.tes_simulasi_peserta');
        $response->assertViewHas('questions');
    }

    public function test_simulation_page_access_blocked_due_to_inactive_session()
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

        // Create user and registration
        $user = User::factory()->create(['username' => 'john_doe']);
        $registration = Registration::factory()->create(['user_id' => $user->id]);

        // Acting as the user
        $this->actingAs($user);

        // No active simulation session or active selection session is blocking
        $response = $this->get(route('user.simulasi', ['username' => 'john_doe']));

        // Assert that the user is redirected back with an error message
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Simulasi tidak dapat diakses karena tidak ada sesi simulasi yang aktif atau sedang berlangsung sesi seleksi.');
    }

    public function test_submit_simulation_answers()
    {
        // // Disable middleware to bypass CSRF and auth checks in this test
        $this->withoutMiddleware();

        // Create user and registration
        $user = User::factory()->create(['username' => 'john_doe']);
        $this->actingAs($user);

        // Prepare answers data
        $answers = json_encode([
            1 => ['A'],
            2 => ['B'],
            3 => ['C'],
            4 => ['D'], // Example answers
        ]);

        // Hit the submit answers route
        $response = $this->postJson(route('user.simulasi.store', ['username' => 'john_doe']), [
            'userAnswers' => $answers
        ]);

        // Assert that the answers were saved to the session
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Jawaban berhasil disimpan']);
        $this->assertEquals(session('userAnswers'), json_decode($answers, true));
    }

    public function test_simulation_result_page()
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

        // Create user, registration, and related skill test
        $user = User::factory()->create(['username' => 'john_doe']);
        $registration = Registration::factory()->create(['user_id' => $user->id]);
        $skillTest = SkillTest::factory()->create();
        $question = Question::factory()->create(['skill_test_id' => $skillTest->id, 'jawaban_benar' => 'A']);

        // Store answers in session using the actual question ID
        session(['userAnswers' => [$question->id => ['A']]]);

        // Acting as the user
        $this->actingAs($user);

        // Hit the result page route
        $response = $this->get(route('user.hasil_simulasi', ['username' => 'john_doe']));

        // Assert correct view and results are calculated
        $response->assertStatus(200);
        $response->assertViewIs('tes-seleksi.hasil_simulasi');
        $response->assertViewHas('scorePercentage');

        // Ensure that the score is correctly calculated
        $this->assertEquals(100, $response->viewData('scorePercentage')); // Full score for correct answers
    }
}
