<?php

namespace Dgo\Cornerstone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static convertTitle($markdown)
 * @method static getRenderedMarkdownFromFile(mixed $markdownPath)
 * @method static getRenderedMarkdownToc(string|null $markdownBody)
 * @method static getBodyContentFromSlug(string $slug)
 *
 */
class MarkdownHelp extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'markdown-help';
    }
}
