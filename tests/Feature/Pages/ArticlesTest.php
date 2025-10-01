<?php

use App\Settings\ArticleSetting;
use Livewire\Volt\Volt;

use function Pest\Laravel\get;

it('check articles page returns a successful response', function () {
    /** @var ArticleSetting $setting */
    $setting = app(ArticleSetting::class);
    $setting->enabled = true;
    $setting->save();

    $response = get(route('articles.index'));

    $response->assertStatus(200);
});

it('articles page has article settings', function () {
    /** @var ArticleSetting $setting */
    $setting = app(ArticleSetting::class);
    $setting->title = fake()->sentence();
    $setting->description = fake()->sentences(asText: true);
    $setting->enabled = true;
    $setting->save();

    Volt::test('articles')
        ->assertSeeText($setting->title)
        ->assertSeeText($setting->description);
});

it('articles page returns 404 when disabled', function () {
    /** @var ArticleSetting $setting */
    $setting = app(ArticleSetting::class);
    $setting->enabled = false;
    $setting->save();

    $response = get(route('articles.index'));

    $response->assertStatus(404);
});
