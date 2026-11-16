<?php

namespace App\Http\Controllers;

use App\Models\LearningCompletion;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExplorationController extends Controller
{
    public function index(Request $request): View
    {
        return view('pages.exploration', $this->viewData($request));
    }

    public function show(Request $request, string $ecosystem): View
    {
        abort_unless(array_key_exists($ecosystem, config('wetland_exploration.ecosystems', [])), 404);

        return view('pages.exploration', $this->viewData($request, $ecosystem));
    }

    private function viewData(Request $request, ?string $selectedKey = null): array
    {
        $definitions = config('wetland_exploration.ecosystems', []);
        $photoCredits = config('wetland_exploration.photo_credits', []);
        $userId = $request->user()->id;
        $visitedHotspots = LearningCompletion::query()
            ->where('user_id', $userId)
            ->where('type', 'exploration_hotspot')
            ->pluck('item_key')
            ->all();
        $completedEcosystems = LearningCompletion::query()
            ->where('user_id', $userId)
            ->where('type', 'exploration')
            ->pluck('item_key')
            ->all();

        $ecosystems = [];
        $visitedTotal = 0;
        $hotspotTotal = 0;

        foreach ($definitions as $key => $definition) {
            $legacyComplete = in_array($key, $completedEcosystems, true);
            foreach ($definition['hotspots'] as $hotspotKey => &$hotspot) {
                $hotspot['image_url'] = asset('images/eksplorasi/'.$hotspot['image']);
                $hotspot['photo_credit'] = $photoCredits[$hotspot['image']] ?? null;
                $hotspot['visited'] = $legacyComplete || in_array($key.':'.$hotspotKey, $visitedHotspots, true);
                $visitedTotal += $hotspot['visited'] ? 1 : 0;
                $hotspotTotal++;
            }
            unset($hotspot);

            $definition['key'] = $key;
            $definition['image_url'] = asset('images/eksplorasi/'.$definition['image']);
            $definition['photo_credit'] = $photoCredits[$definition['image']] ?? null;
            $definition['hotspot_count'] = count($definition['hotspots']);
            $definition['visited_count'] = count(array_filter($definition['hotspots'], fn ($hotspot) => $hotspot['visited']));
            $definition['complete'] = $definition['visited_count'] === $definition['hotspot_count'];
            $definition['url'] = route('exploration.show', $key);
            if (isset($definition['extra']['image'])) {
                $definition['extra']['image_url'] = asset('images/eksplorasi/'.$definition['extra']['image']);
                $definition['extra']['photo_credit'] = $photoCredits[$definition['extra']['image']] ?? null;
            }
            $ecosystems[$key] = $definition;
        }

        $completeEcosystemCount = count(array_filter($ecosystems, fn ($ecosystem) => $ecosystem['complete']));

        return [
            'ecosystems' => $ecosystems,
            'selectedEcosystem' => $selectedKey === null ? null : $ecosystems[$selectedKey],
            'bannerUrl' => asset('images/eksplorasi/'.config('wetland_exploration.banner')),
            'overallVisited' => $visitedTotal,
            'overallTotal' => $hotspotTotal,
            'completeEcosystemCount' => $completeEcosystemCount,
            'ecosystemCount' => count($ecosystems),
        ];
    }
}
