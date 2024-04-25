<?php

use Dgo\Cornerstone\Tests\Fixtures\TemporaryModel;

class CustomTitleModel extends TemporaryModel
{
    public function getCustomTitleIdentifier(): string
    {
        return 'custom_title';
    }
}

it('returns default title identifier', function () {
    $model = new TemporaryModel();
    expect($model->titleIdentifier)->toBe('title');
});

it('can set and get custom title identifier', function () {
    $model = new CustomTitleModel();

    expect($model->titleIdentifier)->toBe('custom_title');
});

it('getCustomTitleIdentifier returns expected value', function () {
    $model = new TemporaryModel();
    expect($model->getCustomTitleIdentifier())->toBe('title');
});
