@props([
    'title',
    'intro',
    'breadcrumb' => null,
])

<div class="mx-auto max-w-3xl">
    <header>
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('home')" icon="home" wire:navigate />
            @isset($breadcrumb)
                <flux:breadcrumbs.item>
                    {{ $breadcrumb }}
                </flux:breadcrumbs.item>
            @endisset
        </flux:breadcrumbs>
        <div class="flex justify-between items-start mt-8 sm:mt-16">
            <div class="space-y-5">
                <h1 class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">
                    {{ $title }}
                </h1>
                <p class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
                    {{ $intro }}
                </p>
            </div>
            {{ $extra ?? '' }}
        </div>
    </header>
    <div class="mt-16 sm:mt-20 space-y-20">
        {{ $slot }}
    </div>
</div>
