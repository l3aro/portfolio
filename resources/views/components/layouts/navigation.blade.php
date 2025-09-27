<flux:header container class="bg-zinc-50 dark:bg-zinc-900 ring-1 ring-zinc-200 dark:ring-zinc-300/20">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    <flux:brand href="#" :logo="asset('images/avatar.jpg')" class="max-lg:hidden" />
    <flux:spacer />
    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
            Home
        </flux:navbar.item>
        <flux:navbar.item
            icon="document-text"
            :href="route('articles.index')"
            :current="request()->routeIs('articles*')"
            wire:navigate
        >
            Articles
        </flux:navbar.item>
    </flux:navbar>
    <flux:spacer />
    <flux:navbar class="me-4">
        <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
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
        <flux:sidebar.brand href="#" :logo="asset('images/avatar.jpg')" :logo:dark="asset('images/avatar.jpg')" />
        <flux:sidebar.collapse
            class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2"
        />
    </flux:sidebar.header>
    <flux:sidebar.nav>
        <flux:sidebar.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
            Home
        </flux:sidebar.item>
        <flux:sidebar.item
            icon="document-text"
            :href="route('articles.index')"
            :current="request()->routeIs('articles*')"
            wire:navigate
        >
            Articles
        </flux:sidebar.item>
    </flux:sidebar.nav>
</flux:sidebar>
