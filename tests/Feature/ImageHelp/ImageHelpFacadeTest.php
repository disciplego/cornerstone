<?php

it('resolves the correct class through the facade alias', function () {
    $resolvedClass = ImageHelp::getFacadeRoot();

    expect($resolvedClass)->toBeInstanceOf(\Dgo\Cornerstone\Helpers\ImageHelp::class);
});

it('is registered as a singleton in the container', function () {
    $firstInstance = app('image-help');
    $secondInstance = app('image-help');

    expect($firstInstance)->toBe($secondInstance);
});
