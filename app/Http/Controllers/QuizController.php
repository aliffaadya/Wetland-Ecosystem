<?php

namespace App\Http\Controllers;

use App\Models\LearningCompletion;
use Illuminate\Http\Request;
use App\Models\EvaluationResult;
use Illuminate\Validation\ValidationException;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        if ($this->missingRequirements($request)) {
            return redirect()->route('dashboard')->with('learning_gate_error', $this->gateMessage($request));
        }

        return view('pages.quiz', ['questions' => $this->publicQuestions()]);
    }

    public function submit(Request $request)
    {
        if ($this->missingRequirements($request)) {
            return redirect()->route('dashboard')->with('learning_gate_error', $this->gateMessage($request));
        }

        $questions = config('wetland_quiz.questions', []);
        $expectedIds = array_map(fn ($question) => (string) $question['id'], $questions);
        $answers = $request->input('answers');

        if (! is_array($answers) || array_diff($expectedIds, array_map('strval', array_keys($answers))) !== []) {
            throw ValidationException::withMessages([
                'answers' => 'Lengkapi semua jawaban sebelum mengumpulkan kuis.',
            ]);
        }

        $validated = $request->validate([
            'answers' => ['required', 'array', 'size:'.count($questions)],
            'answers.*' => ['required', 'integer', 'between:0,3'],
        ]);

        $correctCount = 0;
        $review = [];

        foreach ($questions as $question) {
            $chosen = (int) $validated['answers'][$question['id']];
            $correct = $chosen === $question['answer'];
            $correctCount += $correct ? 1 : 0;
            $review[] = [
                'question' => $question['question'],
                'chosen' => $question['options'][$chosen],
                'correctAnswer' => $question['options'][$question['answer']],
                'correct' => $correct,
                'explanation' => $question['explanation'],
            ];
        }

        $score = (int) round(($correctCount / count($questions)) * 100);

        EvaluationResult::create([
            'user_id' => $request->user()->id,
            'evaluation_key' => 'evaluasi-akhir',
            'evaluation_name' => 'Evaluasi Akhir',
            'score' => $score,
            'correct_answers' => $correctCount,
            'total_questions' => count($questions),
            'completed_at' => now(),
        ]);

        return view('pages.quiz', [
            'questions' => $this->publicQuestions(),
            'results' => [
                'score' => $score,
                'correct' => $correctCount,
                'incorrect' => count($questions) - $correctCount,
                'total' => count($questions),
                'review' => $review,
            ],
        ]);
    }

    private function publicQuestions(): array
    {
        return array_map(fn ($question) => [
            'id' => $question['id'],
            'question' => $question['question'],
            'options' => $question['options'],
        ], config('wetland_quiz.questions', []));
    }

    private function missingRequirements(Request $request): bool
    {
        $completedTopics = $request->user()->learningCompletions()
            ->where('type', 'topic')
            ->pluck('item_key')
            ->all();
        $requiredTopics = array_keys(config('wetland_lessons.exercises', []));

        $explorationComplete = $request->user()->learningCompletions()
            ->where('type', 'exploration')
            ->where('item_key', 'mangrove')
            ->exists();

        return ! $explorationComplete || array_diff($requiredTopics, $completedTopics) !== [];
    }

    private function gateMessage(Request $request): string
    {
        $completedTopics = $request->user()->learningCompletions()
            ->where('type', 'topic')
            ->pluck('item_key')
            ->all();
        $requiredTopics = array_keys(config('wetland_lessons.exercises', []));
        $remainingTopics = count(array_diff($requiredTopics, $completedTopics));
        $explorationComplete = $request->user()->learningCompletions()
            ->where('type', 'exploration')
            ->where('item_key', 'mangrove')
            ->exists();

        $requirements = [];
        if ($remainingTopics > 0) {
            $requirements[] = "selesaikan materi dan seluruh soalnya ({$remainingTopics} materi tersisa)";
        }
        if (! $explorationComplete) {
            $requirements[] = 'selesaikan Eksplorasi Virtual';
        }

        return 'Evaluasi Akhir belum bisa dibuka. Silakan '.implode(' dan ', $requirements).'.';
    }
}
