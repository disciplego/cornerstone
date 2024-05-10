<?php

use Dgo\Cornerstone\CornerstoneServiceProvider;

it('registers the CornerstoneServiceProvider', function () {
    $app = $this->app;
    $registeredProviders = array_keys($app->getLoadedProviders());
    expect($registeredProviders)->toContain(CornerstoneServiceProvider::class);
});

it('merges its configuration properly', function () {
    $this->app->register(CornerstoneServiceProvider::class);
    $config = config('cornerstone');
    expect($config)->toBeArray()
        ->and($config)->toHaveKey('dark_theme_toggle')
        ->and($config['dark_theme_toggle'])->toEqual(true);
});