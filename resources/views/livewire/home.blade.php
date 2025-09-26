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

    #[Computed]
    public function positions()
    {
        return [
            [
                'company' => 'Planetaria',
                'title' => 'CEO',
                'start' => '2019',
                'end' => 'Present',
            ],
            [
                'company' => 'Airbnb',
                'title' => 'Product Designer',
                'start' => '2014',
                'end' => '2019',
            ],
            [
                'company' => 'Facebook',
                'title' => 'iOS Software Engineer',
                'start' => '2011',
                'end' => '2014',
            ],
            [
                'company' => 'Starbucks',
                'title' => 'Shift Supervisor',
                'start' => '2008',
                'end' => '2011',
            ],
        ];
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
            <flux:button href="https://github.com/l3aro" icon="github" target="blank" variant="ghost"></flux:button>
            <flux:button
                href="https://www.linkedin.com/in/bao-duong-924717186/"
                icon="linkedin"
                target="blank"
                variant="ghost"
            ></flux:button>
        </div>
        <div class="mt-24 md:mt-28">
            <div class="mx-auto grid max-w-xl grid-cols-1 gap-y-20 lg:max-w-none lg:grid-cols-2">
                <div class="flex flex-col gap-16">
                    @foreach ($this->articles as $article)
                        <x-home.article :$article />
                    @endforeach
                </div>
                <div class="space-y-10 lg:pl-16 xl:pl-24">
                    <div class="rounded-2xl border border-zinc-100 p-6 dark:border-zinc-700/40">
                        <h2 class="flex text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                            <flux:icon name="briefcase" class="size-6 flex-none" />
                            <span class="ml-3">Work</span>
                        </h2>
                        <ol class="mt-6 space-y-4">
                            @foreach ($this->positions as $position)
                                <x-home.position :$position />
                            @endforeach
                        </ol>

                        <flux:button class="mt-6 w-full transition cursor-pointer" variant="filled">
                            Download CV
                            <flux:icon name="arrow-down" class="size-4" />
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
