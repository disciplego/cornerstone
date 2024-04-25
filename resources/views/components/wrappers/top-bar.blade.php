@props([
    'wrapClasses' => 'w-full bg-white dark:bg-gray-900'
])
<section id="top-bar" {{ $attributes->merge(['class' => $wrapClasses]) }} >
        {{$slot}}
</section>