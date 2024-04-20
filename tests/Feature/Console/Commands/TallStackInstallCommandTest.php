<?php

it('updates package.json correctly', function () {
    // Step 1: Create a Temporary Directory
    $tempDir = sys_get_temp_dir().'/tall-frontend';
    if (! File::exists($tempDir)) {
        File::makeDirectory($tempDir);
    }

    // Step 2: Place a Fake package.json
    $initialData = [
        'devDependencies' => [
            'existing-package' => '^1.0.0',
        ],
    ];
    File::put("{$tempDir}/package.json", json_encode($initialData));

    // Step 3: Run Method
    $command = new \Dgo\Cornerstone\Console\Commands\TallStackInstall();
    $command->updateNodePackages(function ($packages) {
        return [
            '@tailwindcss/aspect-ratio' => '^0.4.2',
            // ... other packages
        ] + $packages;
    }, true, $tempDir);  // Assuming you modify your method to accept a directory path

    // Step 4: Assertions
    $updatedData = json_decode(File::get("{$tempDir}/package.json"), true);
    expect($updatedData['devDependencies'])->toHaveKeys([
        'existing-package',
        '@tailwindcss/aspect-ratio',
        // ... other package names you're adding
    ]);

    // Step 5: Cleanup
    File::deleteDirectory($tempDir);
});
