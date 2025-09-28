@props([
    'experience',
])

@php
    /** @var \App\Data\AboutWorkExperienceData $experience */
@endphp

<section class="md:border-l md:border-zinc-100 md:pl-6 md:dark:border-zinc-700/40">
    <div class="grid max-w-3xl grid-cols-1 gap-y-8 items-baseline md:grid-cols-4">
        <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
            {{ $experience->company }}
        </h3>
        <div class="md:col-span-3 space-y-16">
            <div class="group relative flex flex-col items-start">
                <p
                    class="relative z-10 order-first mb-3 flex items-center text-sm text-zinc-400 dark:text-zinc-500 pl-3.5"
                >
                    <span class="absolute inset-y-0 left-0 flex items-center" aria-hidden="true">
                        <span class="h-4 w-0.5 rounded-full bg-zinc-200 dark:bg-zinc-500"></span>
                    </span>
                    {{ $experience->duration }}
                </p>
                <h4 class="text-base font-semibold tracking-tight text-zinc-800 dark:text-zinc-100">
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
