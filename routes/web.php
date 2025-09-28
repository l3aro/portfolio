<?php

use Livewire\Volt\Volt;

Volt::route('', 'home')->name('home');
Volt::route('articles', 'articles')->name('articles.index');
Volt::route('articles/{slug}', 'article')->name('articles.show');
Volt::route('uses', 'uses')->name('uses.index');
