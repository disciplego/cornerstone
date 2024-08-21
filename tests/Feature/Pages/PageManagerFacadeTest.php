<?php

it('resolves the correct class through the facade alias', function () {
    $resolvedClass = PageManager::getFacadeRoot();

    expect($resolvedClass)->toBeInstanceOf(\Dgo\Cornerstone\Managers\PageManager::class);
});

it('is registered as a singleton in the container', function () {
    $firstInstance = app('page-manager');
    $secondInstance = app('page-manager');

    expect($firstInstance)->toBe($secondInstance);
});
