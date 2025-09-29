<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;

class ViewUses extends SpotlightCommand
{
    protected string $name = 'Uses';

    protected string $description = 'Redirect to Uses';

    protected array $synonyms = [
        'uses',
        'recommendations',
        'tech',
    ];

    public function execute(Spotlight $spotlight)
    {
        $spotlight->redirectRoute('uses.index', navigate: true);
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}
