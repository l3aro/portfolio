@php
    $generalSetting = app(\App\Settings\GeneralSetting::class);
@endphp

<footer
    class="bg-zinc-50 dark:bg-zinc-900 w-screen ring-1 ring-zinc-200 dark:ring-zinc-300/20 max-w-7xl"
    aria-labelledby="footer-heading"
>
    <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
        <div class="flex justify-center md:order-2">
            @foreach (App\Data\SocialData::collect($generalSetting->socials) as $social)
                <flux:button
                    :href="$social->url"
                    :target="$social->openInNewTab ? 'blank' : 'self'"
                    variant="subtle"
                    size="sm"
                >
                    <x-dynamic-component :component="$social->icon" class="size-5" />
                </flux:button>
            @endforeach
        </div>
        <p class="mt-8 text-center text-sm/6 text-zinc-600 md:order-1 md:mt-0 dark:text-zinc-400">
            &copy; {{ now()->year }} {{ $generalSetting->siteName }}. All rights reserved.
        </p>
    </div>
</footer>
