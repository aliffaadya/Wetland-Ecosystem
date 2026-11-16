<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\LearningProgressController;
use App\Http\Controllers\ExplorationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Halaman pembelajaran
Route::get('/tutorial', function () {
    return view('pages.tutorial');
})->middleware('auth')->name('tutorial.index');

Route::middleware('auth')->group(function () {
    Route::post('/learning-progress/topics/{topic}', [LearningProgressController::class, 'completeTopic'])->name('learning-progress.topic');
    Route::post('/learning-progress/exploration', [LearningProgressController::class, 'completeExploration'])->name('learning-progress.exploration');
    Route::post('/learning-progress/exploration/{ecosystem}/{hotspot}', [LearningProgressController::class, 'completeExplorationHotspot'])->name('learning-progress.exploration.hotspot');
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
});

// Fitur Wetland Explorer
Route::get('/exploration', [ExplorationController::class, 'index'])->middleware('auth')->name('exploration.index');
Route::get('/exploration/{ecosystem}', [ExplorationController::class, 'show'])->middleware('auth')->name('exploration.show');

Route::get('/missions', function () {
    return view('pages.missions');
});

// Dashboard siswa - hanya untuk pengguna yang sudah login
Route::get('/dashboard', function () {
    $user = Auth::user();
    $results = $user->evaluationResults()->latest('completed_at')->get();
    $topicCompletions = $user->learningCompletions()
        ->where('type', 'topic')
        ->latest('completed_at')
        ->get();
    $otherCompletions = $user->learningCompletions()
        ->where('type', 'exploration')
        ->latest('completed_at')
        ->get();

    $activities = $topicCompletions->map(fn ($completion) => [
        'name' => 'Materi: '.ucwords(str_replace('-', ' ', $completion->item_key)),
        'completed_at' => $completion->completed_at,
        'score' => null,
        'status' => 'Selesai',
    ])->concat($otherCompletions->map(fn ($completion) => [
        'name' => $completion->item_key === 'mangrove' ? 'Eksplorasi Hutan Mangrove' : 'Eksplorasi: '.ucwords(str_replace('-', ' ', $completion->item_key)),
        'completed_at' => $completion->completed_at,
        'score' => null,
        'status' => 'Selesai',
    ]))->concat($results->map(fn ($result) => [
        'name' => $result->evaluation_name,
        'completed_at' => $result->completed_at,
        'score' => $result->score.'/100 ('.$result->correct_answers.'/'.$result->total_questions.')',
        'status' => $result->score >= 70 ? 'Tuntas' : 'Perlu belajar lagi',
    ]))->sortByDesc('completed_at')->values();

    $topicTotal = count(config('wetland_lessons.exercises', []));
    $completedTopicCount = $topicCompletions->count();
    $learningProgressPercent = $topicTotal > 0 ? (int) round($completedTopicCount / $topicTotal * 100) : 0;

    return view('student.dashboard', [
        'activities' => $activities,
        'evaluationCount' => $results->count(),
        'evaluationScoreTotal' => $results->sum('score'),
        'evaluationAverage' => $results->isEmpty() ? null : (int) round($results->avg('score')),
        'latestEvaluation' => $results->first(),
        'learningProgressPercent' => $learningProgressPercent,
        'completedTopicCount' => $completedTopicCount,
        'topicTotal' => $topicTotal,
    ]);
})->middleware('auth')->name('dashboard');

// Profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autentikasi Breeze
require __DIR__ . '/auth.php';
