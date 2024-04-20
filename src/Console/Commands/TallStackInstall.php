<?php

namespace Dgo\Cornerstone\Console\Commands;

use Illuminate\Console\Command;

class TallStackInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tall:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Tall Stack';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->updateNodePackages(function ($packages) {
            return [
                '@tailwindcss/aspect-ratio' => '^0.4.2',
                '@tailwindcss/forms' => '^0.5.2',
                'autoprefixer' => '^10.4.2',
                'axios' => '^1.1.2',
                'cropperjs' => '^1.6.1',
                'flowbite' => '^1.8.1',
                'flowbite-typography' => '^1.0.3',
                'laravel-vite-plugin' => '^0.8.0',
                'postcss' => '^8.4.6',
                'tailwindcss' => '^3.1.0',
                'tailwindcss-debug-screens' => '^2.2.1',
                'vite' => '^4.0.0',
            ] + $packages;
        });
    }

    public static function updateNodePackages(callable $callback, $dev = true, $directory = null): void
    {
        $directory = $directory ?? base_path();

        if (! file_exists($directory.'/package.json')) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents($directory.'/package.json'), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            $directory.'/package.json',
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }
}
