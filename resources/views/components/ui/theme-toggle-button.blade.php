@if(config('cornerstone.dark_theme_toggle') && auth()->guest())
    <button id="theme-toggle" type="button"
            class="lg:order-last text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full text-sm p-1.5 ml-2">
        <x-icon id="theme-toggle-dark-icon" class="hidden w-5 h-5" name="heroicon-o-moon"/>
        <x-icon id="theme-toggle-light-icon" class="hidden w-5 h-5" name="heroicon-o-sun"/>
        <x-icon id="theme-toggle-system-icon" class="hidden w-5 h-5" name="fas-circle-half-stroke"/>
    </button>
@endif