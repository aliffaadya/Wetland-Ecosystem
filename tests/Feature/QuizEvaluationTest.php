<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\LearningCompletion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuizEvaluationTest extends TestCase
{
    use RefreshDatabase;

    private User $student;

    protected function setUp(): void
    {
        parent::setUp();
        $this->student = User::factory()->create();
        $this->actingAs($this->student);
        foreach (array_keys(config('wetland_lessons.exercises')) as $topic) {
            LearningCompletion::create([
                'user_id' => $this->student->id,
                'type' => 'topic',
                'item_key' => $topic,
                'completed_at' => now(),
            ]);
        }
        LearningCompletion::create([
            'user_id' => $this->student->id,
            'type' => 'exploration',
            'item_key' => 'mangrove',
            'completed_at' => now(),
        ]);
    }

    public function test_quiz_page_shows_questions_without_exposing_answer_keys(): void
    {
        $response = $this->get(route('quiz.index'));

        $response->assertOk()
            ->assertSee('15 SOAL')
            ->assertDontSee('"answer":');
    }

    public function test_server_grades_a_fully_correct_submission(): void
    {
        $answers = [];
        foreach (config('wetland_quiz.questions') as $question) {
            $answers[$question['id']] = $question['answer'];
        }

        $this->post(route('quiz.submit'), ['answers' => $answers])
            ->assertOk()
            ->assertSee('Nilai akhir:')
            ->assertSee('100/100')
            ->assertSee('15 benar · 0 salah · 15 soal');
    }

    public function test_server_grades_a_fully_incorrect_submission(): void
    {
        $answers = [];
        foreach (config('wetland_quiz.questions') as $question) {
            $answers[$question['id']] = ($question['answer'] + 1) % 4;
        }

        $this->post(route('quiz.submit'), ['answers' => $answers])
            ->assertOk()
            ->assertSee('0/100')
            ->assertSee('0 benar · 15 salah · 15 soal');
    }

    public function test_incomplete_submission_is_rejected(): void
    {
        $this->from(route('quiz.index'))
            ->post(route('quiz.submit'), ['answers' => [1 => 0]])
            ->assertRedirect(route('quiz.index'))
            ->assertSessionHasErrors('answers');
    }

    public function test_results_accumulate_and_are_only_visible_to_the_logged_in_student(): void
    {
        $answers = [];
        foreach (config('wetland_quiz.questions') as $question) {
            $answers[$question['id']] = $question['answer'];
        }

        $student = auth()->user();
        $this->post(route('quiz.submit'), ['answers' => $answers]);
        $this->post(route('quiz.submit'), ['answers' => $answers]);
        $this->assertSame(2, $student->evaluationResults()->count());

        $otherStudent = User::factory()->create();
        $this->actingAs($otherStudent)->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Belum ada hasil belajar yang tersimpan.')
            ->assertDontSee('Evaluasi Akhir');

        $this->actingAs($student)->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Evaluasi Akhir')
            ->assertSee('100/100 (15/15)');
    }

    public function test_final_quiz_is_blocked_until_all_topics_and_exploration_are_complete(): void
    {
        $this->student->learningCompletions()->delete();

        $this->get(route('quiz.index'))
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('learning_gate_error');

        $this->post(route('quiz.submit'), ['answers' => []])
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('learning_gate_error');
    }

    public function test_topic_completion_requires_every_answer_to_be_correct(): void
    {
        $topic = array_key_first(config('wetland_lessons.exercises'));
        $this->student->learningCompletions()->where('type', 'topic')->where('item_key', $topic)->delete();
        $correctAnswers = config("wetland_lessons.exercises.{$topic}");
        $wrongAnswers = $correctAnswers;
        $wrongAnswers[0] = ($wrongAnswers[0] + 1) % 4;

        $this->postJson(route('learning-progress.topic', $topic), ['answers' => $wrongAnswers])
            ->assertUnprocessable();
        $this->assertDatabaseMissing('learning_completions', [
            'user_id' => $this->student->id,
            'type' => 'topic',
            'item_key' => $topic,
        ]);

        $this->postJson(route('learning-progress.topic', $topic), ['answers' => $correctAnswers])
            ->assertOk()
            ->assertJson(['completed' => true]);
    }

    public function test_exploration_completion_requires_all_three_hotspots(): void
    {
        $this->postJson(route('learning-progress.exploration'), ['hotspots' => ['pohon', 'akar']])
            ->assertUnprocessable();

        $this->postJson(route('learning-progress.exploration'), ['hotspots' => ['pohon', 'akar', 'perairan']])
            ->assertOk()
            ->assertJson(['completed' => true]);
    }
}
