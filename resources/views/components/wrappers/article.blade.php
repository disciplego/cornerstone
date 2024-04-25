@props([
    'wrapClasses' => 'basis-5/6 mx-auto format max-w-none py-16'
])
<article {{ $attributes->merge(['class' => $wrapClasses]) }} >

        {{$slot}}

</article>