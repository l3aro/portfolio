<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class RecommendationTechnologyData extends Data
{
    public function __construct(
        #[DataCollectionOf(RecommendationTechnologyToolData::class)]
        public DataCollection $tools,
        public string $category,
    ) {}
}
