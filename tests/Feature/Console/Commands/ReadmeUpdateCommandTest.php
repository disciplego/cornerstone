<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

it('updates the README.md file with dependencies', function () {
    // Setup: Create temporary composer.json, package.json, and README.md files
    Storage::fake('temp');
    Storage::disk('temp')->put('composer.json', json_encode(['require' => ['laravel/framework' => '^10.10']]));
    Storage::disk('temp')->put('package.json', json_encode(['dependencies' => ['vue' => '^3.0']]));
    Storage::disk('temp')->put('README.md', "## Composer Dependencies\n\n\n## Composer Dev Dependencies\n\n\n## NPM Dependencies\n\n\n## NPM Dev Dependencies\n\n\n");

    // Run the readme:update command with test-specific files
    Artisan::call('readme:update', [
        'composerPath' => Storage::disk('temp')->path('composer.json'),
        'packagePath' => Storage::disk('temp')->path('package.json'),
        'readmePath' => Storage::disk('temp')->path('README.md'),
    ]);

    // Assertions: Check if README.md is updated as expected
    $updatedReadmeContent = Storage::disk('temp')->get('README.md');
    expect($updatedReadmeContent)->toContain('- laravel/framework: ^10.10')
        ->and($updatedReadmeContent)->toContain('- vue: ^3.0');
});
