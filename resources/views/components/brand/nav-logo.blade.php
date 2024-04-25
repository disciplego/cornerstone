@props(['active'])

@php
    $classes = ($active ?? false)
    ? 'border-primary-500 hover:border-secondary-500'
    : 'border-transparent hover:border-primary-500'
@endphp
<a href="{{Route::has('home') ? route('home') : '/' }}"{{ $attributes->merge(['class' => 'h-full flex items-center border-b-2 '. $classes . '  lg:transition ease-in-out delay-150 lg:hover:-translate-y-0.5 hover:-translate-y-0.5 hover:scale-100 lg:hover:scale-110']) }}>
    <x-dgo::brand.icon />
    <x-dgo::brand.name />
</a>
