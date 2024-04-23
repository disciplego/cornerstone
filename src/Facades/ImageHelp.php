<?php

namespace Dgo\Cornerstone\Facades;

use Illuminate\Support\Facades\Facade;

class ImageHelp extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'image-help';
    }
}
