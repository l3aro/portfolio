<?php

arch()->preset()->php();

arch()->preset()->security();

arch()->preset()->relaxed();

arch()
    ->expect('App')
    ->not
    ->toUse(['die', 'dd', 'dump']);
