<?php

use Dgo\Cornerstone\Facades\ImageHelp;

it('calls generateFaviconSizes with the provided URL', function () {
    // Mock the ImageHelp::generateFaviconSizes method
    ImageHelp::shouldReceive('generateFaviconSizes')
        ->once()
        ->with('https://dummyimage.com/512.png');

    // Run the command
    $this->artisan('favicon:generate', ['url' => 'https://dummyimage.com/512.png']);
});

it('calls generateFaviconSizes without the default URL', function () {
    // Mock the ImageHelp::generateFaviconSizes method
    ImageHelp::shouldReceive('generateFaviconSizes')
        ->once();

    // Run the command
    $this->artisan('favicon:generate');
});
