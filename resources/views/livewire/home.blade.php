<?php

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;

new class extends Component {
    #[Computed]
    public function articles()
    {
        return Article::query()
            ->withWhereHas('url')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();
    }
}; ?>

<div class="mt-9 w-full">
    <div class="mx-auto max-w-3xl">
        <img src="{{ asset('images/avatar.jpg') }}" alt="Avatar" class="w-32 h-32 rounded-full mb-6 mx-auto" />
        <h1 class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">
            Software designer, founder, and amateur astronaut.
        </h1>
        <div class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
            I'm Spencer, a software designer and entrepreneur based in New York City. I'm the founder and CEO of
            Planetaria, where we develop technologies that empower regular people to explore space on their own terms.
        </div>
        <div class="mt-6 flex gap-6">
            <flux:button href="https://github.com/l3aro" icon="github" target="blank"></flux:button>
            <flux:button
                href="https://www.linkedin.com/in/bao-duong-924717186/"
                icon="linkedin"
                target="blank"
            ></flux:button>
        </div>
        <div class="mt-24 md:mt-28">
            <div class="mx-auto grid max-w-xl grid-cols-1 gap-y-20 lg:max-w-none lg:grid-cols-2">
                <div class="flex flex-col gap-16">
                    @foreach ($this->articles as $article)
                        <x-home.article :$article />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
