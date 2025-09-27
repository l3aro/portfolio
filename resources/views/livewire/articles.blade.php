<?php

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Computed]
    public function articles()
    {
        return Article::query()
            ->withWhereHas('url')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->simplePaginate(5);
    }
}; ?>

<x-layouts.page
    title="Writing on software design, company building, and the aerospace industry."
    intro="All of my long-form thoughts on programming, leadership, product design, and more, collected in chronological order."
>
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
