<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;

class ViewAbout extends SpotlightCommand
{
    protected string $name = 'About';

    protected string $description = 'Redirect to About';

    protected array $synonyms = [
        'about',
    ];

    public function execute(Spotlight $spotlight)
    {
        $spotlight->redirectRoute('about.index', navigate: true);
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}
