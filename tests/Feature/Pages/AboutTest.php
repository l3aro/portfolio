<?php

use App\Settings\About;
use Livewire\Volt\Volt;

use function Pest\Laravel\get;

it('check about page returns a successful response', function () {
    /** @var About $setting */
    $setting = app(About::class);
    $setting->enabled = true;
    $setting->save();

    $response = get(route('about.index'));

    $response->assertStatus(200);
});

it('about page has about settings', function () {
    /** @var About $setting */
    $setting = app(About::class);
    $setting->title = fake()->sentence();
    $setting->name = fake()->name();
    $setting->enabled = true;
    $setting->save();

    Volt::test('about')
        ->assertSeeText($setting->title)
        ->assertSeeText($setting->name);
});

it('about page returns 404 when disabled', function () {
    /** @var About $setting */
    $setting = app(About::class);
    $setting->enabled = false;
    $setting->save();

    $response = get(route('about.index'));

    $response->assertStatus(404);
});
