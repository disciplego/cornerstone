<?php

namespace Dgo\Cornerstone\Helpers;

use Intervention\Image\Laravel\Facades\Image;

class ImageHelp
{

    /**
     * Generates a URL for a dummy image with customizable parameters.
     *
     * @param int|string $width Width of the image in pixels.
     * @param int|string $height Height of the image in pixels.
     * @param string $backgroundColor Hex code for background color without '#'.
     * @param string $fontColor Hex code for font color without '#'.
     * @param string $format Image format (e.g., png, jpg).
     * @param string $text Text to display on the image.
     * @return string URL of the generated dummy image.
     */
    public static function getDummyImageUrl(int|string $width = 600, int|string $height = 400, string $backgroundColor = '000', string $fontColor = 'fff', string $format = 'png', string $text = 'Placeholder Image'): string
    {
        $text = urlencode($text);

        return "https://dummyimage.com/{$width}x{$height}/{$backgroundColor}/{$fontColor}.{$format}&text={$text}";
    }

    /**
     * Generates various favicon sizes from a primary favicon URL and saves them to a specified path.
     *
     * @param string|null $primaryFaviconUrl URL of the primary favicon image. Defaults to a standard dummy image if null.
     * @param string|null $savePath Directory path where the favicon images will be saved. Defaults to the public directory if null.
     * @return void
     */
    public static function generateFaviconSizes(?string $primaryFaviconUrl = null, ?string $savePath = null): void
    {
        $savePath = $savePath ?? public_path();

        if (! $primaryFaviconUrl) {
            if(self::isValidImageUrl(config('dgo-image-help.favicon_url'))){
                $primaryFaviconUrl = config('dgo-image-help.favicon_url');
            } else {
                $primaryFaviconUrl = self::getDummyImageUrl();
            }
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

    /**
     * Generates and saves a site.webmanifest file with predefined application icons and theme colors.
     *
     * @param string|null $savePath Directory path where the site manifest will be saved. Defaults to the public directory if null.
     * @return void
     */
    public static function generateSiteManifest(?string $savePath = null): void
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

    public static function isValidImageUrl($url): bool
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return false;
        }

        $path = parse_url($url, PHP_URL_PATH);
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'ico', 'svg'];

        return in_array(strtolower($extension), $validExtensions);
    }
}
