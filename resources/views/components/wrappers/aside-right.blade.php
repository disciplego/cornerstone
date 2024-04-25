@props([
    'wrapClasses' => 'flex flex-col flex-grow'
])
<aside id="aside-right" {{ $attributes->merge(['class' => $wrapClasses]) }} >

        {{$slot}}

</aside>