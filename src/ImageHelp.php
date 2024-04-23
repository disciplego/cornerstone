<?php

namespace Dgo\Cornerstone;

use Intervention\Image\Laravel\Facades\Image;

class ImageHelp
{
    public static function getDummyImageUrl($width = '600', $height = '400', $backgroundColor = '000', $fontColor = 'fff', $format = 'png', $text = 'Image Text'): string
    {
        $text = urlencode($text);

        return "https://dummyimage.com/{$width}x{$height}/{$backgroundColor}/{$fontColor}.{$format}&text={$text}";
    }

    public static function generateFaviconSizes(?string $primaryFaviconUrl = null, ?string $savePath = null)
    {
        $savePath = $savePath ?? public_path();

        if (! $primaryFaviconUrl) {
            $primaryFaviconUrl = 'https://dummyimage.com/512.png';
        }
        $originalImage = file_get_contents($primaryFaviconUrl);
        $faviconSizes = [
            'favicon-16x16.png' => 16,
            'favicon-32x32.png' => 32,
            'favicon.ico' => 48,
            'apple-touch-icon.png' => 180,
            'android-chrome-192x192.png' => 192,
            'android-chrome-512x512.png' => 512,
        ];

        foreach ($faviconSizes as $faviconName => $size) {
            $favicon = Image::read($originalImage)->resize($size, $size);
            $favicon->save("{$savePath}/{$faviconName}");
        }

        self::generateSiteManifest($savePath);
    }

    public static function generateSiteManifest(?string $savePath = null)
    {
        $savePath = $savePath ?? public_path();
        $manifest = [
            'name' => config('app.name'),
            'short_name' => '',
            'icons' => [
                [
                    'src' => '/android-chrome-192x192.png',
                    'sizes' => '192x192',
                    'type' => 'image/png',
                ],
                [
                    'src' => '/android-chrome-512x512.png',
                    'sizes' => '512x512',
                    'type' => 'image/png',
                ],
            ],
            'theme_color' => '#ffffff',
            'background_color' => '#ffffff',
            'display' => 'standalone',
        ];

        $manifestJson = json_encode($manifest, JSON_PRETTY_PRINT);
        file_put_contents("{$savePath}/site.webmanifest", $manifestJson);
    }
}
