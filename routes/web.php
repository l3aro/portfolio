<?php

use Livewire\Volt\Volt;

Volt::route('', 'home')->name('home');
Volt::route('articles', 'articles')->name('articles');
Volt::route('articles/{slug}', 'article')->name('articles.show');
