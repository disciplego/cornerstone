@props([
    'wrapClasses' => 'flex md:flex-row flex-col min-h-svh bg-gray-100 dark:bg-gray-800'
])
<main {{ $attributes->merge(['class' => $wrapClasses]) }} >
        {{$slot}}
</main>