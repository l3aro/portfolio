<?php

use App\Data\RecommendationTechnologyData;
use Livewire\Volt\Component;
use App\Livewire\Concerns\WithSeo;
use App\Settings\TechRecommendation;
use Livewire\Attributes\Computed;

new class extends Component {
    use WithSeo;

    public function mount()
    {
        if (! app(TechRecommendation::class)->enabled) {
            abort(404);
        }

        $this->seo(relativeTitle: 'Uses');
    }

    #[Computed]
    public function pageSetting()
    {
        return app(TechRecommendation::class);
    }

    #[Computed]
    public function technologies()
    {
        return RecommendationTechnologyData::collect($this->pageSetting->technologies);
    }
}; ?>

<x-layouts.page :title="$this->pageSetting->title" :intro="$this->pageSetting->description" breadcrumb="Uses">
    <div class="space-y-20">
        @foreach ($this->technologies as $technology)
            <x-uses.tool-section :$technology />
        @endforeach
    </div>
</x-layouts.page>
