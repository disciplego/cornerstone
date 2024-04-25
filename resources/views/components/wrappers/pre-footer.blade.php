@props([
    'wrapClasses' => ''
])
<section id="pre-footer" {{ $attributes->merge(['class' => $wrapClasses]) }} >
        {{$slot}}
</section>