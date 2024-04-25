@props([
    'wrapClasses' => 'h-20',
    'first_div' => 'h-full w-full flex flex-wrap items-center justify-start mx-auto px-2 sm:px-4'
])
<nav {{ $attributes->merge(['class' => $wrapClasses]) }} >
    <div class="{{$first_div}}">
        {{$slot}}
    </div>
</nav>