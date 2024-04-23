<?php

namespace Dgo\Cornerstone\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use BladeUIKit\BladeUIKitServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Intervention\Image\Laravel\ServiceProvider as ImageServiceProvider;
use Orchestra\Testbench\TestCase as Testbench;
use OwenVoke\BladeFontAwesome\BladeFontAwesomeServiceProvider;

abstract class TestCase extends Testbench
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        // Set the application key
        $this->app['config']->set('app.key', 'base64:'.'d2oyZHh2cG01enZoYXZodzR2ZjBpdnpqcnV3Zmw4MHY=');

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Dgo\\Cornerstone\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    protected function getPackageProviders($app): array
    {
        return [
            'Dgo\Cornerstone\CornerstoneServiceProvider',
            BladeUIKitServiceProvider::class,
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            BladeFontAwesomeServiceProvider::class,
            ImageServiceProvider::class,
        ];
    }
}
