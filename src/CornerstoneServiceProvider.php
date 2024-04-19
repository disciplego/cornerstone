<?php

namespace Dgo\Cornerstone;

use Dgo\Cornerstone\Console\Commands\ReadMeUpdate;
use Dgo\Cornerstone\Console\Commands\TallStackInstall;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Folio\Folio;

class CornerstoneServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dgo');
        $this->loadViewComponentsAs('dgo', [
            \Dgo\Cornerstone\View\Components\Layout::class,
        ]);

        $pagesPath = resource_path('views/pages');

        // Check if the 'pages' directory exists
        if (file_exists($pagesPath)) {
            // Set the path if the directory exists
            Folio::path($pagesPath);
        }

        Folio::path(__DIR__.'/../resources/pages');

        $this->loadRoutesFrom(__DIR__.'/../routes/cornerstone.php');

        Blade::if('configIsSet', function ($config) {
            return config($config) !== null;
        });

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['cornerstone'];
    }

    /**
     * Console-specific booting.
     */
    protected function bootForConsole(): void
    {
        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/dgo'),
        ], 'cornerstone.views');
        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/pages' => base_path('resources/views/pages'),
        ], 'cornerstone.folio');

        // Publishing the TALL Stack frontend base config.js files.
        $this->publishes([
            __DIR__.'/../vite.config.js' => base_path('vite.config.js'),
            __DIR__.'/../tailwind.config.js' => base_path('tailwind.config.js'),
            __DIR__.'/../postcss.config.js' => base_path('postcss.config.js'),
            __DIR__.'/../package.json' => base_path('package.json'),

        ], 'tall.install');

        // Publishing the TALL Stack frontend resource files.
        $this->publishes([
            __DIR__.'/../resources/css' => resource_path('css'),
            __DIR__.'/../resources/js' => resource_path('js'),
        ], 'tall.install');

        // Publishing assets.
        $this->publishes([
            __DIR__.'/../resources/tests' => base_path('tests'),
            __DIR__.'/../resources/tests/packages' => base_path('tests/packages'),
            __DIR__.'/../resources/root/phpunit.xml' => base_path('phpunit.xml'),
        ], 'cornerstone.pest');

        $this->publishes([
            __DIR__.'/../resources/root/README.md' => base_path('README.md'),
        ], 'cornerstone.readme');

        $this->publishes([
            __DIR__.'/../resources/root/.gitignore' => base_path('.gitignore'),
        ], 'cornerstone.gitignore');

        $this->publishes([
            __DIR__.'/../todo' => base_path('todo'),
        ], 'cornerstone.todo');

        $this->publishes([
            __DIR__.'/../.env.example' => base_path('.env.example'),
        ], 'cornerstone.readme');

        $this->commands([
            ReadmeUpdate::class,
            TallStackInstall::class,
        ]);
    }
}
