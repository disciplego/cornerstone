<x-html class="font-sans  bg-gray-100 dark:bg-gray-800 {{app()->isLocal() ? ' debug-screens ' : '' }}"

        :title="isset($title) ? $title . ' | ' . config('app.name') : config('app.name')"

>
    <x-slot:head>

        <x-dgo::utilities.google-tag />

        <x-dgo::utilities.favicons/>

        @googlefonts
        @if (app()->isLocal())
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        @endif
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <!-- Dark Mode Toggle -->
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>

    </x-slot:head>

    @isset($header)
            {{ $header }}
    @endisset

    @isset($hero)
            {{ $hero }}
    @endisset

    @isset($main)
            {{$main}}
    @endisset

    {{$slot}}

    @isset($preFooter)
        <x-dgo::wrappers.pre-footer>
            {{ $preFooter }}
        </x-dgo::wrappers.pre-footer>
    @endisset

    @isset($footer)
            {{ $footer }}
    @endisset

    @vite(['resources/js/scripts.js'])
    @livewireScripts
</x-html>
