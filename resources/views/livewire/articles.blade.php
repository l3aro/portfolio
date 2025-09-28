<?php

use App\Livewire\Concerns\WithSeo;
use App\Models\Article;
use App\Settings\ArticleSetting;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    use WithSeo;

    #[Computed]
    public function articles()
    {
        return Article::query()
            ->withWhereHas('url')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->simplePaginate(5);
    }

    #[Computed]
    public function pageSetting()
    {
        return app(ArticleSetting::class);
    }

    public function mount()
    {
        if (! $this->pageSetting->enabled) {
            abort(404);
        }

        $this->seo(relativeTitle: 'Articles');
    }
}; ?>

<x-layouts.page :title="$this->pageSetting->title" :intro="$this->pageSetting->description" breadcrumb="Articles">
    <div class="md:border-l md:border-zinc-100 md:pl-6 md:dark:border-zinc-700/40">
        <div class="flex max-w-3xl flex-col space-y-16">
            @foreach ($this->articles as $article)
                <x-articles.article :$article />
            @endforeach
        </div>
    </div>
    <div class="mt-6">
        {{ $this->articles->links(data: ['scrollIntoViewOptions' => ['behavior' => 'smooth']]) }}
    </div>
</x-layouts.page>
