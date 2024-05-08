<?php

it('resolves the correct class through the facade alias', function () {
    $resolvedClass = SushiHelp::getFacadeRoot();

    expect($resolvedClass)->toBeInstanceOf(Dgo\Cornerstone\SushiHelp::class);
});

it('is registered as a singleton in the container', function () {
    $firstInstance = app('sushi-help');
    $secondInstance = app('sushi-help');

    expect($firstInstance)->toBe($secondInstance);
});