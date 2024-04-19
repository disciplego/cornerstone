<?php

use Dgo\Cornerstone\CornerstoneServiceProvider;

it('registers the CornerstoneServiceProvider', function () {
    $app = $this->app;
    $registeredProviders = array_keys($app->getLoadedProviders());
    expect($registeredProviders)->toContain(CornerstoneServiceProvider::class);
});
