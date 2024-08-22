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
        "./node_modules/flowbite/**/*.js",
        './resources/vendor/disciplego/resources/**/*.blade.php',
        './resources/vendor/disciplego/resources/**/*.{php,js,vue}'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
                serif: ['Bruno Ace', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                primary: colors.indigo,
                secondary: colors.gray,
                success: colors.green,
                warning: colors.yellow,
                danger: colors.rose,
                indigo: {
                    50: "#ece9fc",
                    100: "#d8d2f9",
                    200: "#c4bbf6",
                    300: "#b0a3f3",
                    400: "#9c8cef",
                    500: "#8875ec",
                    600: "#745de9",
                    700: "#6046e6",
                    800: "#4834ac",
                    900: "#241a55",
                },
                gray: {
                    50: "#f8f9fa",
                    100: "#f2f3f5",
                    200: "#e2e4e9",
                    300: "#cbcfd7",
                    400: "#949dad",
                    500: "#5a6880",
                    600: "#4b576b",
                    700: "#37404f",
                    800: "#1f232c",
                    900: "#181c23",
                },
            },
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        color: theme("colors.gray.700"),
                        h1: {
                            color: theme("colors.primary.700"),
                        },
                        h2: {
                            color: theme("colors.secondary.700"),
                        },
                        h3: {
                            color: theme("colors.primary.700"),
                        },
                        h4: {
                            color: theme("colors.secondary.700"),
                        },
                        h5: {
                            color: theme("colors.primary.700"),
                        },
                        h6: {
                            color: theme("colors.secondary.600"),
                        },
                    },
                    // fontSize: {
                    //     sm: '0.8rem',
                    //     base: '1rem',
                    //     xl: '1.25rem',
                    //     '2xl': '1.563rem',
                    //     '3xl': '1.953rem',
                    //     '4xl': '2.441rem',
                    //     '5xl': '3.052rem',
                    // },
                },
            }),
        },
    },

    plugins: [
        forms,
        require("@tailwindcss/typography"),
        require('flowbite/plugin'),
        require('flowbite-typography'),
        require('tailwindcss-debug-screens'),
    ],
};
