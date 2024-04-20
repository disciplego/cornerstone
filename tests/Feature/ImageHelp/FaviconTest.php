<?php

use \Dgo\Cornerstone\Facades\ImageHelp;

it('generates dummy favicon sizes and site webmanifest', function () {
    // Arrange
    $tempDir = sys_get_temp_dir();

    // Act
    ImageHelp::generateFaviconSizes(null, $tempDir);

    // Assert
    expect(file_exists("{$tempDir}/favicon-16x16.png"))->toBeTrue()
        ->and(file_exists("{$tempDir}/favicon-32x32.png"))->toBeTrue()
        ->and(file_exists("{$tempDir}/favicon.ico"))->toBeTrue()
        ->and(file_exists("{$tempDir}/apple-touch-icon.png"))->toBeTrue()
        ->and(file_exists("{$tempDir}/android-chrome-192x192.png"))->toBeTrue()
        ->and(file_exists("{$tempDir}/android-chrome-512x512.png"))->toBeTrue()
        ->and(file_exists("{$tempDir}/site.webmanifest"))->toBeTrue();
});

it('overwrites existing favicon sizes and site manifest', function () {
    // Arrange
    $tempDir = sys_get_temp_dir();


    // First generation
    ImageHelp::generateFaviconSizes(null, $tempDir);

    // Capture modification times
    $initialModTime = filemtime("{$tempDir}/favicon-16x16.png");

    // Wait for a second to ensure the modification time will change

    sleep(1);

    // Second generation
    ImageHelp::generateFaviconSizes('https://dummyimage.com/1000.png', $tempDir);

    // Assert
    $newModTime = filemtime("{$tempDir}/favicon-16x16.png");
    expect($newModTime)->toBeGreaterThan($initialModTime);
});