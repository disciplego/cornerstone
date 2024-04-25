
<x-dgo::layouts.app :$title :$trackingId >



    <x-slot:main>
        <x-slot:article >
           {!! MarkdownHelp::getBodyContentFromSlug('terms') !!}
        </x-slot:article>
    </x-slot:main>

    <x-slot:preFooter>

    </x-slot:preFooter>

    <x-slot:footer>

    </x-slot:footer>
</x-dgo::layouts.app>


