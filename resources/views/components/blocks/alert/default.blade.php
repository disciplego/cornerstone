@props(['type' => '', 'icon' => 'fas-info-circle', 'dismiss' => true, 'fixed' => true ,'fixedClasses' => 'fixed top-0 left-1/2 transform -translate-x-1/2  z-50'])
@switch($type)
    @case('info')
    @php $bg = 'bg-blue-50 dark:bg-gray-800'; $text = 'text-blue-800 dark:text-blue-400'; $button = 'text-blue-500 dark:text-blue-400 bg-blue-50 dark:bg-gray-800 focus:ring-blue-400 hover:bg-blue-200 dark:hover:bg-gray-700'; @endphp
    @break
    @case('success')
    @php $bg = 'bg-green-50 dark:bg-green-800'; $text = 'text-green-800 dark:text-green-400'; $button = 'text-green-500 dark:text-green-400 bg-green-50 dark:bg-gray-800 focus:ring-green-400 hover:bg-green-200 dark:hover:bg-gray-700'; @endphp
    @break
    @case('warning')
    @php $bg = 'bg-yellow-50 dark:bg-yellow-800'; $text = 'text-yellow-800 dark:text-yellow-400'; $button = 'text-red-500 dark:text-red-400 bg-red-50 dark:bg-gray-800 focus:ring-red-400 hover:bg-red-200 dark:hover:bg-gray-700'; @endphp
    @break
    @case('danger')
    @php $bg = 'bg-red-50 dark:bg-red-800'; $text = 'text-red-800 dark:text-red-400'; $button = 'text-yellow-500 dark:text-yellow-400 bg-yellow-50 dark:bg-gray-800 focus:ring-yellow-400 hover:bg-yellow-200 dark:hover:bg-gray-700'; @endphp
    @break
    @default
    @php $bg = 'bg-gray-50 dark:bg-gray-800'; $text = 'text-gray-800 dark:text-gray-300'; $button = 'text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 focus:ring-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700'; @endphp
@endswitch
@if($slot && ! $slot->isEmpty())
    <div id="alert-{{$type}}1"
         class="@if($fixed){{$fixedClasses }}@endif flex items-center justify-center p-4 mb-4 rounded-lg mx-auto max-w-screen-lg {{$bg}} {{$text}}"
         role="alert">
        <x-icon :name="$icon" class="w-6 h-6 flex-shrink-0 mr-4"/>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-base font-medium">
            {{ $slot }}
        </div>
        <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5  inline-flex items-center justify-center h-8 w-8 {{$button}}"
                data-dismiss-target="#alert-{{$type}}1" aria-label="Close">
            <span class="sr-only">Close</span>
            <x-icon :name="'fas-xmark'" class="w-5 h-5"/>
        </button>
    </div>
@endif

