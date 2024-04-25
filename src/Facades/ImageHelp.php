<?php

namespace Dgo\Cornerstone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getDummyImageUrl($width = 640, $height = 480)
 */
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
