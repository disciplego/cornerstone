<?php

use Dgo\Cornerstone\Traits\SushiChef;
use Illuminate\Database\Eloquent\Model;

class SushiTest extends Model {
    use SushiChef;
};

beforeEach(function () {
    $this->model = new SushiTest();
});


it('uses the Sushi trait', function () {
    expect(in_array(\Dgo\Cornerstone\Traits\SushiChef::class, class_uses_recursive($this->model)))->toBeTrue()
        ->and(in_array(\Sushi\Sushi::class, class_uses_recursive($this->model)))->toBeTrue();
});

// Route key name
it('returns slug as route key name', function () {
    expect($this->model->getRouteKeyName())->toBe('slug');
});

it('can change the route key name', function () {
    $newKeyName = 'new_key_name';
    $this->model->setRouteKeyName($newKeyName);
    expect($this->model->getRouteKeyName())->toBe($newKeyName);
});

// Should Cache
it('returns correct values for shouldCache', function () {
    $this->model->setShouldCache(true);
    expect($this->model->getShouldCache())->toBeTrue();
    $this->model->setShouldCache(false);
    expect($this->model->getShouldCache())->not()->toBeTrue();
});

// Json File Path
it('returns correct data from JSON file', function () {
    $this->model->setFilePath('tests/Fixtures/blog-test.json');
    expect($this->model->getJsonData())->toBeArray()->not()->toBeEmpty();
});

// Data Helpers
it('merges data correctly', function () {
    $jsonData = [['slug' => 'test', 'title' => 'Test']];
    $databaseData = [['slug' => 'test2', 'title' => 'Test 2']];
    $mergedData = $this->model->mergeData($jsonData, $databaseData);
    expect($mergedData)->toHaveCount(2);
});

it('checks and modifies slugs correctly', function () {
    config(['sushi-chef.duplicate_slug_suffix' => '-test']);
    $rows = $this->model->checkSlugs([['slug' => 'test', 'title' => 'Test'], ['title' => 'Test']]);
    expect($rows)->toHaveCount(2)
        ->and($rows[1]['slug'])->toBe(Str::slug('Test') . '-test');
});