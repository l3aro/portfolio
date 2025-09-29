<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;

class ViewArticles extends SpotlightCommand
{
    protected string $name = 'Articles';

    protected string $description = 'Redirect to Articles';

    protected array $synonyms = [
        'articles',
    ];

    public function execute(Spotlight $spotlight)
    {
        $spotlight->redirectRoute('articles.index', navigate: true);
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}
