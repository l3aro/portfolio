<?php

use App\Settings\TechRecommendation;
use Livewire\Volt\Volt;

use function Pest\Laravel\get;

it('check uses page returns a successful response', function () {
    /** @var TechRecommendation $setting */
    $setting = app(TechRecommendation::class);
    $setting->enabled = true;
    $setting->save();

    $response = get(route('uses.index'));

    $response->assertStatus(200);
});

it('uses page has tech recommendation settings', function () {
    /** @var TechRecommendation $setting */
    $setting = app(TechRecommendation::class);
    $setting->title = fake()->sentence();
    $setting->description = fake()->sentences(asText: true);
    $setting->enabled = true;
    $setting->save();

    Volt::test('uses')
        ->assertSeeText($setting->title)
        ->assertSeeText($setting->description);
});

it('uses page returns 404 when disabled', function () {
    /** @var TechRecommendation $setting */
    $setting = app(TechRecommendation::class);
    $setting->enabled = false;
    $setting->save();

    $response = get(route('uses.index'));

    $response->assertStatus(404);
});
