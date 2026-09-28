<?php

use function Pest\Laravel\get;

test('it should be possible to access the home page.', function () {
    get(route('home'))->assertOk();
});
