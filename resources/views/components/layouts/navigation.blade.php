@php
    $setting = app(\App\Settings\GeneralSetting::class);
    $logo = str($setting->siteLogo)->isNotEmpty()
        ? Storage::disk($setting->disk())->url($setting->siteLogo)
        : asset('images/avatar.jpg');
@endphp

<flux:header container class="bg-zinc-50 dark:bg-zinc-900 ring-1 ring-zinc-200 dark:ring-zinc-300/20">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    <flux:brand :href="route('home')" :logo="$logo" class="max-lg:hidden" wire:navigate />
    <flux:spacer />
    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
            Home
        </flux:navbar.item>

        @if (app(\App\Settings\About::class)->enabled)
            <flux:navbar.item
                icon="user-circle"
                :href="route('about.index')"
                :current="request()->routeIs('about*')"
                wire:navigate
            >
                About
            </flux:navbar.item>
        @endif

        @if (app(\App\Settings\ArticleSetting::class)->enabled)
            <flux:navbar.item
                icon="document-text"
                :href="route('articles.index')"
                :current="request()->routeIs('articles*')"
                wire:navigate
            >
                Articles
            </flux:navbar.item>
        @endif

        @if (app(\App\Settings\TechRecommendation::class)->enabled)
            <flux:navbar.item
                icon="wrench-screwdriver"
                :href="route('uses.index')"
                :current="request()->routeIs('uses*')"
                wire:navigate
            >
                Uses
            </flux:navbar.item>
        @endif
    </flux:navbar>
    <flux:spacer />
    <flux:navbar class="me-4">
        <div x-data>
            <flux:input
                as="button"
                placeholder="Search..."
                icon="magnifying-glass"
                kbd="⌘K"
                x-on:click="$dispatch('toggle-spotlight')"
            />
        </div>
        <flux:dropdown x-data align="end">
            <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
                <flux:icon.sun
                    x-show="$flux.appearance === 'light'"
                    variant="mini"
                    class="text-zinc-500 dark:text-white"
                />
                <flux:icon.moon
                    x-show="$flux.appearance === 'dark'"
                    variant="mini"
                    class="text-zinc-500 dark:text-white"
                />
                <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
            </flux:button>
            <flux:menu>
                <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">
                    System
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:navbar>
</flux:header>
<flux:sidebar
    sticky
    collapsible="mobile"
    class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700"
>
    <flux:sidebar.header>
        <flux:sidebar.brand :href="route('home')" :logo="$logo" :logo:dark="$logo" wire:navigate />
        <flux:sidebar.collapse
            class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2"
        />
    </flux:sidebar.header>
    <flux:sidebar.nav>
        <flux:sidebar.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
            Home
        </flux:sidebar.item>
        @if (app(\App\Settings\ArticleSetting::class)->enabled)
            <flux:sidebar.item
                icon="document-text"
                :href="route('articles.index')"
                :current="request()->routeIs('articles*')"
                wire:navigate
            >
                Articles
            </flux:sidebar.item>
        @endif

        @if (app(\App\Settings\TechRecommendation::class)->enabled)
            <flux:sidebar.item
                icon="wrench-screwdriver"
                :href="route('uses.index')"
                :current="request()->routeIs('uses*')"
                wire:navigate
            >
                Uses
            </flux:sidebar.item>
        @endif
    </flux:sidebar.nav>
</flux:sidebar>
