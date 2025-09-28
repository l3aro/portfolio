@props([
    'skill',
])

@php
    /** @var \App\Data\AboutSkillData $skill */
@endphp

<section class="md:border-l md:border-zinc-100 md:pl-6 md:dark:border-zinc-700/40">
    <div class="grid max-w-3xl grid-cols-2 gap-y-8 items-baseline">
        <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
            {{ str($skill->type)->snake()->replace('_', ' ')->title() }}
        </h3>
        <ul class="list-disc ml-4">
            @foreach ($skill->skill as $item)
                <li class="relative z-10 mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    </div>
</section>
