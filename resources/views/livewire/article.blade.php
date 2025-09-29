<?php

use App\Models\Article;
use Livewire\Volt\Component;
use App\Livewire\Concerns\WithSeo;
use App\Settings\ArticleSetting;

new class extends Component {
    use WithSeo;

    public Article $article;

    public function mount(string $slug)
    {
        if (! app(ArticleSetting::class)->enabled) {
            abort(404);
        }

        $this->article = Article::query()
            ->whereHas('url', function ($query) use ($slug) {
                $query->where('slug', $slug)
                    ->where('urlable_type', new Article()->getMorphClass());
            })
            ->firstOrFail();

        $this->seo(
            relativeTitle: $this->article->title,
            description: $this->article->description,
            keywords: $this->article->tags->pluck('name')->toArray(),
        );
    }
}; ?>

<div class="mx-auto max-w-3xl">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('home')" icon="home" wire:navigate />
        <flux:breadcrumbs.item :href="route('articles.index')" wire:navigate>
            {{ __('Articles') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            {{ $article->title }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <article class="mt-8 sm:mt-16" x-init="hljs.highlightAll()">
        <header class="flex flex-col">
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">
                {{ $article->title }}
            </h1>
            <time
                datetime="{{ $article->published_at->format('Y-m-d') }}"
                class="order-first flex items-center text-base text-zinc-400 dark:text-zinc-500"
            >
                <span class="h-4 w-0.5 rounded-full bg-zinc-200 dark:bg-zinc-500"></span>
                <span class="ml-3">{{ $article->published_at->format('F j, Y') }}</span>
            </time>
        </header>
        <div class="prose dark:prose-invert mt-8 max-w-none">
            {{ str($article->content)->toHtml() }}
        </div>
    </article>
</div>
