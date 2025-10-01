<?php

arch()->preset()->php();

arch()->preset()->security();

arch()->preset()->relaxed();

arch()
    ->expect('App')
    ->not
    ->toUse(['die', 'dd', 'dump']);


it('check config', function () {
    echo config('app.name');

    echo config('auth.cv.auth.username');

    echo config('auth.cv.auth.password');
});
