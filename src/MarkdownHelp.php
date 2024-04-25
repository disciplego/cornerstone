<?php

namespace Dgo\Cornerstone;

use DirectoryIterator;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class MarkdownHelp extends MarkdownRenderer
{
    public function getContentWithFrontMatter($markdown): Document
    {
        // Grab the front matter:
        return YamlFrontMatter::parse($markdown);

    }

    public function convertTitle(string $markdown): string
    {
        $html = $this->toHtml($markdown);
        $html = $this->customMarkdownConvert($html);
        $html = $this->stripOuterDivTags($html);
        $html = $this->stripLeadingHeadingTags($html);
        $html = $this->stripPTags($html);
        $html = $this->removeNewlineCharacters($html);

        return $html;
    }

    public function customMarkdownConvert($html): array|string
    {
        return str_replace(['~!', '!~', '~-', '-~'], ['<span class="text-primary-700 font-bold">', '</span>', '<span class="underline font-bold decoration-primary-700">', '</span>', ''], $html);
    }

    public function stripOuterDivTags($html): array|string|null
    {
        return preg_replace('/<div.*?>(.*?)<\/div>/s', '$1', $html);
    }

    public function stripLeadingHeadingTags($html): array|string|null
    {
        return preg_replace(['/<h1.*?>(.*?)<\/h1>/s', '/<h2.*?>(.*?)<\/h2>/s', '/<h3.*?>(.*?)<\/h3>/s',
            '/<h4.*?>(.*?)<\/h4>/s', '/<h5.*?>(.*?)<\/h5>/s', '/<h6.*?>(.*?)<\/h6>/s'], '$1', $html);
    }

    public function stripPTags($html): array|string
    {
        return str_replace(['<p>', '</p>'], [''], $html);
    }

    public function stripOuterPTags($html): array|string|null
    {
        return preg_replace('/<p.*?>(.*?)<\/p>/s', '$1', $html);
    }

    public function removeNewlineCharacters(string $html): string
    {
        return str_replace(["\n", "\r"], '', $html);
    }

    public function convertLeadParagraph(string $markdown): string
    {
        $html = $this->toHtml($markdown);
        $html = $this->stripLeadingHeadingTags($html);
        $html = $this->stripOuterDivTags($html);
        $html = $this->stripOuterPTags($html);
        $html = $this->convertTitle($markdown);

        return $html;
    }

    public function stripMarkdown($raw): string
    {
        return trim(strip_tags($this->convertTitle($raw)));
    }

    public function convertJumbotron($markdown)
    {
        return $this->customMarkdownConvert(
            str_replace(['<h2>', '</h2>', '<h1>', '</h1>'],
                ['<h3 class="text-8xl font-medium my-4 text-gray-400">', '</h3>', '<h3 class="text-8xl font-medium my-4 text-primary-500">', '</h3>'],
                $this->toHtml(strip_tags($markdown))));

    }

    public function getBodyContentFromSlug($slug): ?String
    {
        $paths = [
            __DIR__ . "/../resources/markdown/pages/{$slug}.md",
            resource_path("markdown/pages/{$slug}.md"),
            resource_path("markdown/pages/{$slug}/index.md")
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                return $this->getRenderedMarkdownBodyFromFile($path);
            }
        }

        return null;
    }

    public function getBodyMarkdownFromSlug($slug): ?String
    {
        $paths = [
            __DIR__ . "/../resources/markdown/pages/{$slug}.md",
            resource_path("markdown/pages/{$slug}.md"),
            resource_path("markdown/pages/{$slug}/index.md")
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                return $this->getMarkdownFromFile($path)->body();
            }
        }

        return null;
    }

    public function getMarkdownFromFile($filePath)
    {
        if($markdown = $this->getContentWithFrontMatter(file_get_contents($filePath)))
        {
            return $markdown;
        }
        return null;
    }

    public function getRenderedMarkdownBodyFromFile($filePath)
    {
        if($markdown = $this->getContentWithFrontMatter(file_get_contents($filePath)))
        {
            return $this->convertToHtml($this->customMarkdownConvert($markdown->body()))->getContent();
        }
        return null;
    }

    public function getFileListFromDirectory($path, $extension = 'md')
    {
        $filesPath = [
            __DIR__ . "/../resources/markdown/pages/{$path}/",
            resource_path("markdown/pages/{$path}"),
            resource_path("markdown/pages/{$path}")
        ];
        $list = [];
        foreach ($filesPath as $dirPath) {
            if(is_dir($dirPath))
            {
                foreach (new DirectoryIterator($dirPath) as $fileInfo) {
                    if ($fileInfo->isFile() && $fileInfo->getExtension() === $extension) {

                        $list[] = [$fileInfo->getBaseName(".".$extension)];
                    }
                }
                return $list;
            }
        }

        return null;

    }

}