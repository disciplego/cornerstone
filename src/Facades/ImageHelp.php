<?php

namespace Dgo\Cornerstone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getDummyImageUrl(string $width = '600', string $height = '400', string $backgroundColor = '000', string $fontColor = 'fff', string $format = 'png', string $text = 'Image Text')
 * @method static void generateFaviconSizes(string $primaryFaviconUrl = null, string $savePath = null)
 * @method static void generateSiteManifest(string $savePath = null)
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
