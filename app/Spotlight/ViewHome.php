<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;

class ViewHome extends SpotlightCommand
{
    protected string $name = 'Home';

    protected string $description = 'Redirect to Home';

    protected array $synonyms = [
        'home',
    ];

    public function execute(Spotlight $spotlight)
    {
        $spotlight->redirectRoute('home', navigate: true);
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}
