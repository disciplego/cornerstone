<?php

namespace Dgo\Cornerstone;

use Dgo\Cornerstone\Console\Commands\GenerateFaviconSizesCommand;
use Dgo\Cornerstone\Console\Commands\ReadMeUpdate;
use Dgo\Cornerstone\Console\Commands\TallStackInstall;
use Dgo\Cornerstone\ImageHelp;
use Dgo\Cornerstone\MarkdownHelp;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Folio\Folio;
use Livewire\Volt\Volt;

class CornerstoneServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dgo');
        $this->loadViewsFrom(__DIR__ . '/../resources/markdown/pages', 'markdown');
        $this->loadViewComponentsAs('dgo', [
            View\Components\Layouts\Layout::class,
        ]);

        // Set default view data
        View::share([
            'trackingId' => config('cornerstone.google_analytics_id'),
            'title' => null,
            'mainMenuItems' => config('cornerstone.main_menu_items'),
            'footerMenuItems' => config('cornerstone.footer_menu_items'),
            'socialMenuItems' => config('cornerstone.social_menu_items'),
            'hideMainMenu' => false,
        ]);

        Volt::mount([
            resource_path('views/pages'),
            resource_path('views/livewire'),
            resource_path('pages'),
        ]);

        $pagesPath = resource_path('views/pages');

        // Check if the 'pages' directory exists
        if (file_exists($pagesPath)) {
            // Set the path if the directory exists
            Folio::path($pagesPath);
        }

        Folio::path(__DIR__ . '/../resources/pages');

        $this->loadRoutesFrom(__DIR__ . '/../routes/cornerstone.php');

        Blade::if('configIsSet', function ($config) {
            return config($config) !== null;
        });

        if (!class_exists('ImageHelp')) {
            class_alias(\Dgo\Cornerstone\Facades\ImageHelp::class, 'ImageHelp');
        }

        if (!class_exists('MarkdownHelp')) {
            class_alias(\Dgo\Cornerstone\Facades\MarkdownHelp::class, 'MarkdownHelp');
        }

        if (!class_exists('ModelHelp')) {
            class_alias(\Dgo\Cornerstone\Facades\ModelHelp::class, 'ModelHelp');
        }

        if (!class_exists('SushiHelp')) {
            class_alias(\Dgo\Cornerstone\Facades\SushiHelp::class, 'SushiHelp');
        }

        Blade::directive('titleTextRender', function ($markdown) {
            return "<?php echo MarkdownHelp::convertTitle($markdown); ?>";
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
        $this->mergeConfigFrom(__DIR__ . '/../config/cornerstone.php', 'cornerstone');
        $this->mergeConfigFrom(__DIR__ . '/../config/dgo-pages.php', 'dgo-pages');
        $this->mergeConfigFrom(__DIR__ . '/../config/google-fonts.php', 'google-fonts');
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-ui-kit.php', 'blade-ui-kit');

        $this->app->singleton('image-help', function () {
            return new ImageHelp;
        });
        $this->app->singleton('markdown-help', function ($app) {
            return new MarkdownHelp;
        });
        $this->app->singleton('model-help', function ($app) {
            return new ModelHelp($app->make(Filesystem::class));
        });

        $this->app->singleton('sushi-help', function ($app) {
            return new SushiHelp;
        });
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
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/cornerstone.php' => config_path('cornerstone.php'),
            __DIR__ . '/../config/dgo-pages.php' => config_path('dgo-pages.php'),
            __DIR__ . '/../config/google-fonts.php' => config_path('google-fonts.php'),
            //            __DIR__.'/../config/seo.php' => config_path('seo.php'),
            //            __DIR__.'/../config/livewire.php' => config_path('livewire.php'),
            //            __DIR__.'/../config/blade-ui-kit.php' => config_path('blade-ui-kit.php'),
        ], 'cornerstone.config');

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/dgo'),
        ], 'cornerstone.views');
        // Publishing the views.
        $this->publishes([
            __DIR__ . '/../resources/pages' => base_path('resources/views/pages'),
        ], 'cornerstone.folio');

        // Publishing the TALL Stack frontend base config.js files.
        $this->publishes([
            __DIR__ . '/../vite.config.js' => base_path('vite.config.js'),
            __DIR__ . '/../tailwind.config.js' => base_path('tailwind.config.js'),
            __DIR__ . '/../postcss.config.js' => base_path('postcss.config.js'),
            __DIR__ . '/../package.json' => base_path('package.json'),

        ], 'tall.install');

        // Publishing the TALL Stack frontend resource files.
        $this->publishes([
            __DIR__ . '/../resources/css' => resource_path('css'),
            __DIR__ . '/../resources/js' => resource_path('js'),
        ], 'tall.install');

        // Publishing assets.
        $this->publishes([
            __DIR__ . '/../resources/tests' => base_path('tests'),
            __DIR__ . '/../resources/tests/packages' => base_path('tests/packages'),
            __DIR__ . '/../resources/root/phpunit.xml' => base_path('phpunit.xml'),
        ], 'cornerstone.pest');

        $this->publishes([
            __DIR__ . '/../resources/root/README.md' => base_path('README.md'),
        ], 'cornerstone.readme');

        $this->publishes([
            __DIR__ . '/../resources/root/.gitignore' => base_path('.gitignore'),
        ], 'cornerstone.gitignore');

        $this->publishes([
            __DIR__ . '/../todo' => base_path('todo'),
        ], 'cornerstone.todo');

        $this->publishes([
            __DIR__ . '/../.env.example' => base_path('.env.example'),
        ], 'cornerstone.readme');

        $this->commands([
            ReadmeUpdate::class,
            TallStackInstall::class,
            GenerateFaviconSizesCommand::class,
        ]);
    }
}
