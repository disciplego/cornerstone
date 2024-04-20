<?php

namespace Dgo\Cornerstone\Tests;

use BladeUIKit\BladeUIKitServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Intervention\Image\Laravel\ServiceProvider as ImageServiceProvider;
use Orchestra\Testbench\TestCase as Testbench;

abstract class TestCase extends Testbench
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();

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
            ImageServiceProvider::class
        ];
    }
}
