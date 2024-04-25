@props(['icon' => 'fas-bullhorn', 'dismiss' => true, 'fixed' => true ,'fixedClasses' => 'fixed top-0 left-0 z-40'])
@if(! $slot->isEmpty())
    <div id="sticky-banner" tabindex="-1" class="@if($fixed){{$fixedClasses }}@endif flex justify-between w-full p-4  ">
        <div class="flex items-center mx-auto">
            <p class="flex items-center text-sm font-normal text-gray-500 dark:text-gray-400">
            <span class="inline-flex p-1 mr-3 bg-gray-200 rounded-full dark:bg-gray-600 w-6 h-6 items-center justify-center">
                <x-icon :name="$icon" class="w-4 h-4 text-gray-500 dark:text-gray-400"/>
            </span>
                <span class="format text-primary-700 dark:text-primary-300"> {{$slot}} </span>
            </p>
        </div>
        @if($dismiss)
            <div class="flex items-center">
                <button data-dismiss-target="#sticky-banner" type="button" class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close banner</span>
                </button>
            </div>
        @endif
    </div>
@endif