import defaultTheme from 'tailwindcss/defaultTheme';
const colors = require('tailwindcss/colors');
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/**/*.blade.php',
        "./resources/**/*.blade.php",
        './resources/**/*.html',
        './app/**/*.php',
        './resources/**/*.js',
        './resources/**/*.jsx',
        './resources/**/*.ts',
        './resources/**/*.tsx',
        './resources/**/*.php',
        './resources/**/*.vue',
        './resources/**/*.twig',
        './vendor/filament/**/*.blade.php',
        "./vendor/awcodes/curator/resources/views/**/*.blade.php",
        './storage/framework/views/*.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
                serif: ['Bruno Ace', ...defaultTheme.fontFamily.serif],
            },

        },
    },

    plugins: [
        forms,
        require('flowbite-typography'),
        require('tailwindcss-debug-screens'),
        require('flowbite/plugin'),
        require('flowbite-typography')
    ],
};
