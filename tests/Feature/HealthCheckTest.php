<?php

it('check config', function () {
    echo config('app.name');

    echo config('auth.cv.auth.username');

    echo config('auth.cv.auth.password');
});

it('check health returns a successful response', function () {
    $response = $this->get('/up');

    $response->assertStatus(200);
});
