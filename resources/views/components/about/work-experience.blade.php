@props([
    'experience',
])

@php
    /** @var \App\Data\AboutWorkExperienceData $experience */
@endphp

<section class="md:border-l md:border-zinc-100 md:pl-6 md:dark:border-zinc-700/40">
    <div class="grid max-w-3xl grid-cols-1 gap-y-8 items-baseline md:grid-cols-4">
        <div class="flex flex-col gap-2">
            <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
                {{ $experience->company }}
            </h3>
            <p class="relative z-10 mb-3 flex items-center text-sm text-zinc-400 dark:text-zinc-500">
                {{ $experience->duration }}
            </p>
        </div>
        <div class="md:col-span-3 space-y-16">
            <div class="group relative flex flex-col items-start">
                <h4 class="text-base tracking-tight text-zinc-800 dark:text-zinc-100">
                    {{ $experience->role }}
                </h4>
                <ul class="list-disc ml-4">
                    @foreach ($experience->responsibilities as $responsibility)
                        <li class="relative z-10 mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            {{ $responsibility }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
