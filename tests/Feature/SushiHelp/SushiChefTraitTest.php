<?php

use Dgo\Cornerstone\Traits\SushiChef;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Sushi\Sushi;

class SushiTest extends Model {
    use Sushi, SushiChef;

    protected function sushiShouldCache()
    {
        return $this->sushiShouldCacheChef();
    }

    public function getRows()
    {
        return $this->getRowsChef();
    }

    protected function afterMigrate(Blueprint $table): void
    {
        $this->afterMigrateChef($table);
    }

};

beforeEach(function () {
    config(['sushi-chef.should_cache' => false]);
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
it('returns correct values for shouldCache', function ($configValue, $setValue, $expectedResult) {
    config(['sushi-chef.should_cache' => $configValue]);
    $this->model->setShouldCache($setValue);
    expect($this->model->getShouldCache())->toBe($expectedResult);
})->with([
    [true, null, true],
    [false, null, false],
    [true, true, true],
    [true, false, false],
]);

// Json Data
it('returns correct data from JSON file', function () {

    $this->model->setFilePath('tests/Fixtures/blog-test.json');

    expect($this->model->getRowsChef())->toBeArray()->not()->toBeEmpty();
});

it('returns empty array if JSON file does not exist', function () {
    $this->model->setFilePath('tests/Fixtures/non-existent.json');
    expect($this->model->getRowsChef())->toBeArray()->toBeEmpty();
});

it('returns empty array if no file path is set', function () {
    expect($this->model->getRowsChef())->toBeArray()->toBeEmpty();
});

it('can override row data', function () {
    $this->model->setRowData([['title' => 'Test', 'slug' => 'test']]);

    expect($this->model->getRowsChef())->toBeArray()->toHaveCount(1)
        ->and($this->model->getRowsChef())->toContain(['title' => 'Test', 'slug' => 'test']);
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