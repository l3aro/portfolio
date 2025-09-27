<?php

use App\Models\Article;
use Livewire\Volt\Component;

new class extends Component {
    public Article $article;

    public function mount(string $slug)
    {
        $this->article = Article::query()
            ->whereHas('url', function ($query) use ($slug) {
                $query->where('slug', $slug)
                    ->where('urlable_type', new Article()->getMorphClass());
            })
            ->firstOrFail();
    }
}; ?>

<div class="mt-16 lg:mt-32">
    <div class="xl:relative">
        <div class="mx-auto max-w-3xl">
            <article>
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
                <div class="prose dark:prose-invert mt-8">
                    {{ str($article->content)->toHtml() }}
                </div>
            </article>
        </div>
    </div>
</div>
