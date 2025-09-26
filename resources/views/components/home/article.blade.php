@props([
    'article',
])

@php
    /** @var \App\Models\Article $article */
@endphp

<article class="group relative flex flex-col items-start">
    <h2 class="text-base font-semibold tracking-tight text-zinc-800 dark:text-zinc-100">
        <div
            class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-zinc-50 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 sm:-inset-x-6 sm:rounded-2xl dark:bg-zinc-800/50"
        ></div>
        <a href="{{ $article->url->slug }}">
            <span class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"></span>
            <span class="relative z-10">{{ $article->title }}</span>
        </a>
    </h2>
    <time
        class="relative z-10 order-first mb-3 flex items-center text-sm text-zinc-400 dark:text-zinc-500 pl-3.5"
        datetime="2022-09-05"
    >
        <span class="absolute inset-y-0 left-0 flex items-center" aria-hidden="true">
            <span class="h-4 w-0.5 rounded-full bg-zinc-200 dark:bg-zinc-500"></span>
        </span>
        {{ $article->published_at->format('F j, Y') }}
    </time>
    <p class="relative z-10 mt-2 text-sm text-zinc-600 dark:text-zinc-400">
        {{ $article->description }}
    </p>
    <div aria-hidden="true" class="relative z-10 mt-4 flex items-center text-sm font-medium text-teal-500">
        Read article

        <flux:icon name="chevron-right" variant="mini" class="size-4 ml-1" />
    </div>
</article>
