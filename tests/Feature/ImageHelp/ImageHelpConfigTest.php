<?php

use Dgo\Cornerstone\CornerstoneServiceProvider;
use Illuminate\Support\Facades\Config;

it('merges its configuration properly', function () {
    $this->app->register(CornerstoneServiceProvider::class);
    $config = config('dgo-image-help');
    expect($config)->toBeArray()
        ->and($config)->toHaveKey('favicon_url')
        ->and($config['favicon_url'])->toEqual(resource_path('images/favicon.png'));
});

it('checks that the SITE_FAVICON_URL env value is used in the image-help config', function () {
    // Set the .env value for SITE_FAVICON_URL
    Config::set('dgo-image-help.favicon_url', 'https://example.com/favicon.ico');

    // Assert that the config file returns the correct value from the .env
    expect(config('dgo-image-help.favicon_url'))->toBe('https://example.com/favicon.ico');
});
