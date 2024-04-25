@props([
    'wrapClasses' => 'flex flex-wrap justify-between items-center'
])
<section id="banner" {{ $attributes->merge(['class' => $wrapClasses]) }} >

        {{$slot}}

</section>