<?php

use App\Settings\Landing;
use Livewire\Volt\Volt;

use function Pest\Laravel\get;

it('check home page returns a successful response', function () {
    $response = get(route('home'));

    $response->assertStatus(200);
});

it('home page has landing settings', function () {
    /** @var Landing $setting */
    $setting = app(Landing::class);
    $setting->title = fake()->sentence();
    $setting->description = fake()->sentences(asText: true);
    $setting->save();

    Volt::test('home')
        ->assertSeeText($setting->title)
        ->assertSeeText($setting->description);
});
