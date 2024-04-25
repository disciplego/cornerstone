@props(['item' => null, 'help_text' => null])

@php
    if(isset($item['help_text']) && ! $help_text)
    {
        $help_text = $item['help_text'];
    }
@endphp
@if(app()->runningUnitTests() || isset($item))
<div data-popover
     id="{{ isset($item) ? 'target_' . $item['id'] . $item['slug'] : '' }}"
     role="tooltip"
        {{ $attributes->merge(['class' => 'absolute z-50 invisible inline-block text-center text-sm  text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-primary-800']) }}>
    <div class="px-3 py-2">
        <p>{{ isset($item) ? ($help_text ?? $slot) : $slot }}</p>
    </div>
    <div data-popper-arrow></div>
</div>
@endif