<?php

namespace Dgo\Cornerstone\Facades;

use Illuminate\Support\Facades\Facade;
use Spatie\YamlFrontMatter\Document;

/**
 * @method static Document getContentWithFrontMatter(string $markdown)
 * @method static string convertTitle(string $markdown)
 * @method static array|string customMarkdownConvert(string $html)
 * @method static array|string|null stripOuterDivTags(string $html)
 * @method static array|string|null stripLeadingHeadingTags(string $html)
 * @method static array|string stripPTags(string $html)
 * @method static array|string|null stripOuterPTags(string $html)
 * @method static string removeNewlineCharacters(string $html)
 * @method static string convertLeadParagraph(string $markdown)
 * @method static string stripMarkdown(string $raw)
 * @method static string|array convertJumbotron(string $markdown)
 * @method static string|null getBodyContentFromSlug(string $slug)
 * @method static string|null getBodyMarkdownFromSlug(string $slug)
 * @method static Document|null getMarkdownFromFile(string $filePath)
 * @method static string|null getRenderedMarkdownBodyFromFile(string $filePath)
 * @method static array|null getFileListFromDirectory(string $path, string $extension = 'md')
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
