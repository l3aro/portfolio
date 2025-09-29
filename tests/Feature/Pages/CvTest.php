<?php

use App\Models\User;
use App\Settings\About;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('check cv page returns a successful response', function () {
    $user = User::query()->where('email', config('auth.cv.auth.username'))->first();
    actingAs($user);

    $response = get(route('cv'));

    $response->assertStatus(200);
});

it('cv page has about settings', function () {
    /** @var About $setting */
    $setting = app(About::class);
    $setting->title = fake()->sentence();
    $setting->name = fake()->name();
    $setting->enabled = true;
    $setting->save();

    Volt::test('cv')
        ->assertSeeText($setting->title)
        ->assertSeeText($setting->name);
});

it('cv page requires authentication', function () {
    $response = get(route('cv'));

    $response->assertStatus(401);
});
