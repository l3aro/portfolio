<?php

namespace App\Spotlight;

use App\Models\Article;
use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class SearchArticle extends SpotlightCommand
{
    protected string $name = 'Search Article';

    protected string $description = 'Search for an article';

    protected array $synonyms = [
        'search',
        'article',
    ];

    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
            ->add(SpotlightCommandDependency::make('article')->setPlaceholder('Search for an article'));
    }

    public function searchArticle($query)
    {
        return Article::search($query)
            ->query(fn($builder) => $builder->select(['id', 'title', 'description']))
            ->get()
            ->map(fn(Article $article) => new SpotlightSearchResult(
                id: $article->getKey(),
                name: $article->title,
                description: str($article->description)->words(20, '...'),
                synonyms: [sprintf('View article %s', $article->title)],
            ));
    }

    public function execute(Spotlight $spotlight, Article $article)
    {
        $spotlight->redirectRoute('articles.show', ['slug' => $article->url->slug], navigate: true);
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}
