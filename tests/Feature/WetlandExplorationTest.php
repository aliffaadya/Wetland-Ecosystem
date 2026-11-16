<?php

namespace Tests\Feature;

use App\Models\LearningCompletion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WetlandExplorationTest extends TestCase
{
    use RefreshDatabase;

    private User $student;

    protected function setUp(): void
    {
        parent::setUp();
        $this->student = User::factory()->create();
        $this->actingAs($this->student);
    }

    public function test_exploration_landing_page_lists_all_four_ecosystems_and_overall_progress(): void
    {
        $this->get(route('exploration.index'))
            ->assertOk()
            ->assertSee('Rawa')
            ->assertSee('Hutan Mangrove')
            ->assertSee('Lahan Gambut')
            ->assertSee('Danau dan Kawasan Sekitar Sungai')
            ->assertSee('Mulai menjelajah')
            ->assertSee('Progres seluruh eksplorasi:')
            ->assertSee('pemandangan_lahan_basah.jpeg')
            ->assertSee('aria-current="page"', false);

        $this->assertSame(4, count(config('wetland_exploration.ecosystems')));
    }

    public function test_each_ecosystem_detail_has_its_main_photo_hotspots_popup_and_return_link(): void
    {
        foreach (config('wetland_exploration.ecosystems') as $key => $ecosystem) {
            $response = $this->get(route('exploration.show', $key));
            $response->assertOk()
                ->assertSee($ecosystem['title'])
                ->assertSee($ecosystem['image'])
                ->assertSee(route('exploration.index'))
                ->assertSee('id="infoPopup"', false)
                ->assertSee('id="closePopup"', false)
                ->assertSee('Klik penanda', false);

            foreach ($ecosystem['hotspots'] as $hotspot) {
                $response->assertSee('data-hotspot="', false)
                    ->assertSee($hotspot['label']);
            }
        }
    }

    public function test_all_configured_local_images_exist_and_mangrove_extra_asset_is_distinct(): void
    {
        $photos = ['bekantan.jpeg', 'danau dan sungai.jpeg', 'embung_bakar.jpeg', 'lahan_gambut.jpeg', 'mangrove.jpeg', 'mangrovee.jpeg', 'pemandangan_lahan_basah.jpeg', 'pop_gambut.jpeg', 'pop_mangrove.jpeg', 'pop_rawa.jpeg', 'pop_sungai.jpeg', 'rawa.jpeg', 'tanah_gambut.jpeg', 'tumbuhan_rawa.jpeg', 'vegetasi_gambut.jpeg'];
        foreach ($photos as $photo) {
            $path = public_path('images/eksplorasi/'.$photo);
            $this->assertFileExists($path, $photo);
            $this->assertNotFalse(getimagesize($path), $photo.' must be a readable image');
        }

        $this->assertNotSame(
            hash_file('sha256', public_path('images/eksplorasi/mangrove.jpeg')),
            hash_file('sha256', public_path('images/eksplorasi/mangrovee.jpeg')),
        );
    }

    public function test_hotspot_progress_is_saved_once_per_student_and_marks_ecosystem_complete(): void
    {
        $url = route('learning-progress.exploration.hotspot', ['ecosystem' => 'rawa', 'hotspot' => 'air-rawa']);
        $this->postJson($url)->assertOk()->assertJson(['visited' => true, 'ecosystemComplete' => false]);
        $this->postJson($url)->assertOk();
        $this->assertSame(1, $this->student->learningCompletions()->where('type', 'exploration_hotspot')->count());

        foreach (['tumbuhan-rawa', 'burung-air'] as $hotspot) {
            $this->postJson(route('learning-progress.exploration.hotspot', ['ecosystem' => 'rawa', 'hotspot' => $hotspot]))->assertOk();
        }

        $this->assertDatabaseHas('learning_completions', [
            'user_id' => $this->student->id,
            'type' => 'exploration',
            'item_key' => 'rawa',
        ]);
        $this->get(route('exploration.show', 'rawa'))
            ->assertOk()
            ->assertSee('3 dari 3')
            ->assertSee('Eksplorasi Rawa selesai!');
    }

    public function test_invalid_hotspots_and_unknown_ecosystems_are_rejected(): void
    {
        $this->postJson(route('learning-progress.exploration.hotspot', ['ecosystem' => 'rawa', 'hotspot' => 'not-a-hotspot']))->assertNotFound();
        $this->get(route('exploration.show', 'unknown'))->assertNotFound();
    }

    public function test_exploration_progress_is_isolated_per_student(): void
    {
        $this->postJson(route('learning-progress.exploration.hotspot', ['ecosystem' => 'rawa', 'hotspot' => 'air-rawa']))
            ->assertOk();

        $otherStudent = User::factory()->create();
        $this->actingAs($otherStudent)->get(route('exploration.show', 'rawa'))
            ->assertOk()
            ->assertSee('0 dari 3')
            ->assertDontSee('sudah dijelajahi');
    }
}
