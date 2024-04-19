<?php

it('publishes the config.js base files', function () {
    $this->artisan('vendor:publish', [
        '--tag' => 'tall.install',
        '--force' => true,
    ])->assertExitCode(0);

    $files = [
        'vite.config.js',
        'tailwind.config.js',
        'postcss.config.js',
        'package.json',
    ];
    foreach ($files as $file) {
        expect(File::exists(base_path($file)))->toBeTrue();
        if (File::exists(base_path($file))) {
            File::delete(base_path($file));
        }
    }
});

it('publishes the resource files', function () {
    $this->artisan('vendor:publish', [
        '--tag' => 'tall.install',
        '--force' => true,
    ])->assertExitCode(0);

    $files = [
        'css',
        'js',
    ];
    foreach ($files as $file) {
        expect(File::exists(resource_path($file)))->toBeTrue();
        if (File::exists(resource_path($file))) {
            File::deleteDirectory(resource_path($file));
        }
    }
});
