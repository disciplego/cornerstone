<?php

it('resolves the correct class through the facade alias', function () {
    $resolvedClass = ModelHelp::getFacadeRoot();

    expect($resolvedClass)->toBeInstanceOf(\Dgo\Cornerstone\Helpers\ModelHelp::class);
});

it('is registered as a singleton in the container', function () {
    $firstInstance = app('model-help');
    $secondInstance = app('model-help');

    expect($firstInstance)->toBe($secondInstance);
});