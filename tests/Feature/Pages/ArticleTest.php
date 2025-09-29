<?php

use App\Models\Article;
use App\Settings\ArticleSetting;
use Livewire\Volt\Volt;

use function Pest\Laravel\get;

it('check article page returns a successful response', function () {
    /** @var ArticleSetting $setting */
    $setting = app(ArticleSetting::class);
    $setting->enabled = true;
    $setting->save();

    $article = Article::factory()->create();

    $response = get(route('articles.show', ['slug' => $article->url->slug]));

    $response->assertStatus(200);
});

it('article page shows article content', function () {
    /** @var ArticleSetting $setting */
    $setting = app(ArticleSetting::class);
    $setting->enabled = true;
    $setting->save();

    $article = Article::factory()->create([
        'title' => 'Test Article Title',
        'description' => 'Test article description',
        'content' => 'Test article content',
    ]);

    Volt::test('article', ['slug' => $article->url->slug])
        ->assertSeeText('Test Article Title')
        ->assertSeeText('Test article content');
});

it('article page returns 404 when articles disabled', function () {
    /** @var ArticleSetting $setting */
    $setting = app(ArticleSetting::class);
    $setting->enabled = false;
    $setting->save();

    $article = Article::factory()->create();

    $response = get(route('articles.show', ['slug' => $article->url->slug]));

    $response->assertStatus(404);
});

it('article page returns 404 for non-existent slug', function () {
    /** @var ArticleSetting $setting */
    $setting = app(ArticleSetting::class);
    $setting->enabled = true;
    $setting->save();

    $response = get(route('articles.show', ['slug' => 'non-existent-slug']));

    $response->assertStatus(404);
});
