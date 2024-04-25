@aware(['page'])
<blockquote
        class="before:hidden format sm:max-w-xl md:max-w-2xl lg:max-w-6xl text-left p-4 my-4 mx-auto border-l-4 border-primary-300 bg-primary-50 dark:border-primary-500 dark:bg-primary-300">
    <p class="mr-4 text-base md:text-2xl italic font-medium leading-relaxed text-gray-900 dark:text-white">{{$page['hero']['quote']['text']}}</p>
    @isset($page['hero']['quote']['reference'])
        <div class="flex space-x-3">
            <x-icon name="fas-bible"
                    class="h-5 md:h-7 mt-0.5 md:mt-0 text-primary-700 dark:text-primary-500"/>
            <div class="flex items-center pb-4">
                <cite class="pr-2 text-base md:text-xl font-semibold text-primary-700 dark:text-primary-500">{{$page['hero']['quote']['reference']}}</cite>
                <cite class="font-base text-base md:text-lg text-primary-700 dark:text-primary-500 uppercase">({{$page['hero']['quote']['version']}})
                </cite>
            </div>
        </div>
    @endisset
</blockquote>