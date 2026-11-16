<?php

namespace App\Http\Controllers;

use App\Models\LearningCompletion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LearningProgressController extends Controller
{
    public function completeExplorationHotspot(Request $request, string $ecosystem, string $hotspot): JsonResponse
    {
        $definition = config("wetland_exploration.ecosystems.{$ecosystem}");
        abort_unless(is_array($definition) && array_key_exists($hotspot, $definition['hotspots']), 404);

        LearningCompletion::firstOrCreate(
            ['user_id' => $request->user()->id, 'type' => 'exploration_hotspot', 'item_key' => $ecosystem.':'.$hotspot],
            ['completed_at' => now()],
        );

        $visitedCount = $request->user()->learningCompletions()
            ->where('type', 'exploration_hotspot')
            ->where('item_key', 'like', $ecosystem.':%')
            ->count();
        $complete = $visitedCount >= count($definition['hotspots']);

        if ($complete) {
            LearningCompletion::firstOrCreate(
                ['user_id' => $request->user()->id, 'type' => 'exploration', 'item_key' => $ecosystem],
                ['completed_at' => now()],
            );
        }

        return response()->json(['visited' => true, 'ecosystemComplete' => $complete]);
    }

    public function completeTopic(Request $request, string $topic): JsonResponse
    {
        $answerKey = config("wetland_lessons.exercises.{$topic}");
        abort_unless(is_array($answerKey), 404);

        $validated = $request->validate([
            'answers' => ['required', 'array', 'size:'.count($answerKey)],
            'answers.*' => ['required', 'integer', 'between:0,3'],
        ]);

        $answers = array_values($validated['answers']);
        if ($answers !== $answerKey) {
            throw ValidationException::withMessages([
                'answers' => 'Semua soal materi harus dijawab dengan benar untuk menandai materi selesai.',
            ]);
        }

        LearningCompletion::firstOrCreate(
            ['user_id' => $request->user()->id, 'type' => 'topic', 'item_key' => $topic],
            ['completed_at' => now()],
        );

        return response()->json(['completed' => true]);
    }

    public function completeExploration(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'hotspots' => ['required', 'array', 'size:3'],
            'hotspots.*' => ['required', 'string', 'in:pohon,akar,perairan'],
        ]);

        $hotspots = array_values(array_unique($validated['hotspots']));
        sort($hotspots);
        $expected = config('wetland_lessons.exploration_hotspots');
        sort($expected);

        if ($hotspots !== $expected) {
            throw ValidationException::withMessages([
                'hotspots' => 'Kunjungi semua hotspot sebelum menyelesaikan eksplorasi.',
            ]);
        }

        LearningCompletion::firstOrCreate(
            ['user_id' => $request->user()->id, 'type' => 'exploration', 'item_key' => 'mangrove'],
            ['completed_at' => now()],
        );

        return response()->json(['completed' => true]);
    }
}
