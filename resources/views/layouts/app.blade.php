<x-html

        :title="isset($title) ? $title . ' | ' . config('app.name') : config('app.name')"

>
    <x-slot:head>

        <x-dgo::utilities.google-tag />
        <x-dgo::utilities.favicons/>

    </x-slot:head>

    {{ $slot }}

</x-html>
