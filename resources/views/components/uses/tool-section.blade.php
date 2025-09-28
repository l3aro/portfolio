@props([
    'technology',
])

@php
    /** @var \App\Data\RecommendationTechnologyData $technology */
@endphp

<section class="md:border-l md:border-zinc-100 md:pl-6 md:dark:border-zinc-700/40">
    <div class="grid max-w-3xl grid-cols-1 gap-y-8 items-baseline md:grid-cols-4">
        <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
            {{ $technology->category }}
        </h2>
        <ul class="md:col-span-3 space-y-16">
            @foreach ($technology->tools as $tool)
                <x-uses.tool :$tool />
            @endforeach
        </ul>
    </div>
</section>
