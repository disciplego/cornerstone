<?php

use Dgo\Cornerstone\Facades\MarkdownHelp;
use Illuminate\Support\Facades\Blade;

it('can convert a title and strip the leading heading tags', function ($markdown) {
    $title = MarkdownHelp::convertTitle($markdown);
    expect(trim($title))->toEqual('Hello World');
})->with([
    '# Hello World',
    '## Hello World',
    '### Hello World',
    '#### Hello World',
    '##### Hello World',
    '###### Hello World',
]);

it('renders custom title markdown with the convertTitle method', function ($markdown, $expectedOutput) {

    expect(MarkdownHelp::convertTitle($markdown))->toEqual($expectedOutput);
})->with([
    ['# ~!Hello!~ World', '<span class="text-primary-700 font-bold">Hello</span> World'],
    ['# ~-Hello-~ World', '<span class="underline font-bold decoration-primary-700">Hello</span> World'],
]);

it('compiles the titleTextRender Blade directive to the appropriate PHP code', function () {
    $markdown = '# ~!Hello!~ World';
    $expectedPhpCode = '<?php echo MarkdownHelp::convertTitle("# ~!Hello!~ World"); ?>';

    expect(Blade::compileString('@titleTextRender("'.$markdown.'")'))->toEqual($expectedPhpCode);
});
