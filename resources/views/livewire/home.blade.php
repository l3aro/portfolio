<?php

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;
use App\Livewire\Concerns\WithSeo;
use App\Actions\GenerateCvForDownload;
use App\Settings\About;
use App\Settings\GeneralSetting;
use App\Settings\Landing;
use App\Settings\ArticleSetting;
use App\Data\AboutWorkExperienceData;
use App\Data\SocialData;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Notifications\Notification;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

new class extends Component {
    use WithSeo;
    use WithRateLimiting;

    #[Computed]
    public function articles()
    {
        if (! app(ArticleSetting::class)->enabled) {
            return [];
        }

        return Article::query()
            ->withWhereHas('url')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->select(['id', 'title', 'description', 'published_at'])
            ->take(3)
            ->get();
    }

    #[Computed]
    public function landing()
    {
        return app(Landing::class);
    }

    #[Computed]
    public function about()
    {
        return app(About::class);
    }

    #[Computed]
    public function positions()
    {
        return AboutWorkExperienceData::collect($this->about->workExperience);
    }

    #[Computed]
    public function socials()
    {
        return SocialData::collect(app(GeneralSetting::class)->socials);
    }

    public function download()
    {
        try {
            $this->rateLimit(maxAttempts: 1, component: 'home');
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title('Too many requests')
                ->body("Slow down! Please wait another {$exception->secondsUntilAvailable} seconds to download my CV.")
                ->warning()
                ->send();

            return;
        }

        return response()
            ->download(GenerateCvForDownload::make()->handle())
            ->deleteFileAfterSend(true);
    }

    public function mount()
    {
        $this->seo(relativeTitle: 'Home');
    }
}; ?>

<div class="mt-9 w-full">
    <div class="mx-auto max-w-3xl">
        @if ($this->landing->avatar)
            <img
                src="{{ Storage::disk($this->landing->disk())->url($this->landing->avatar) }}"
                alt="Avatar"
                class="w-32 h-32 rounded-full mb-6 mx-auto"
            />
        @endif

        <h1 class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">
            {{ $this->landing->title }}
        </h1>
        <div class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
            {{ $this->landing->description }}
        </div>
        <div class="mt-6 flex gap-2">
            @foreach ($this->socials ?? [] as $social)
                <flux:button :href="$social->url" :target="$social->openInNewTab ? 'blank' : 'self'" variant="ghost">
                    <x-dynamic-component :component="$social->icon" class="size-6" />
                </flux:button>
            @endforeach
        </div>
        <div class="mt-24 md:mt-28">
            <div class="mx-auto grid max-w-xl grid-cols-1 gap-y-20 lg:max-w-none lg:grid-cols-2">
                <div class="flex flex-col gap-16">
                    @foreach ($this->articles as $article)
                        <x-home.article :$article />
                    @endforeach
                </div>
                <div class="space-y-10 lg:pl-16 xl:pl-10">
                    @if ($this->about->enabled)
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

                            <flux:button
                                wire:click="download"
                                class="mt-6 w-full transition cursor-pointer"
                                variant="filled"
                            >
                                <div class="flex items-center gap-2">
                                    Download CV
                                    <flux:icon name="arrow-down" class="size-4" />
                                </div>
                            </flux:button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
