<?php

it('can get markdown from a file', function () {
    $markdown = MarkdownHelp::getMarkdownFromFile('./tests/Fixtures/test-file.md');

    expect($markdown->body())->toContain('# Hello World')
        ->and($markdown->matter())->toContain('Test Title');
});

it('can convert markdown from a file with no front matter', function () {
    $markdown = MarkdownHelp::getMarkdownFromFile('./tests/Fixtures/test-file-no-front-matter.md');

    expect($markdown->body())->toContain('# Hello World')
        ->and($markdown->matter())->toBeEmpty();
});

it('can get rendered markdown from a file', function () {
    $markdown = MarkdownHelp::getRenderedMarkdownBodyFromFile('./tests/Fixtures/test-file.md');

    expect($markdown)->toContain('<h1 id="hello-world">Hello World</h1>');
});

it('can get body content from a slug if file exists', function () {
    $markdown = MarkdownHelp::getBodyContentFromSlug('terms');

    expect($markdown)->toContain('Terms and Conditions');
});