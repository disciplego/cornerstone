import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/scripts.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
                'resources/**',
                'app/Filament/**',
                'app/Modules/**',
                'app/Dgo/**',
            ],
        }),
    ],
});