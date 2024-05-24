<?php

use Dgo\Cornerstone\Traits\SushiChef;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Sushi\Sushi;

class SushiTest extends Model {
    use Sushi, SushiChef;

    public function getRows()
    {
        return self::$rows;
    }

    protected function sushiShouldCache()
    {
        return $this->sushiShouldCacheChef();
    }



    protected function afterMigrate(Blueprint $table): void
    {
        $this->afterMigrateChef($table);
    }

};

beforeEach(function () {
    config(['sushi-chef.should_cache' => false]);
});


it('uses the Sushi trait', function () {
    expect(in_array(\Dgo\Cornerstone\Traits\SushiChef::class, class_uses_recursive(SushiTest::class)))->toBeTrue()
        ->and(in_array(\Sushi\Sushi::class, class_uses_recursive(SushiTest::class)))->toBeTrue();
});

// Route key name
it('returns slug as route key name', function () {
    expect((new SushiTest())->getRouteKeyName())->toBe('slug');

});

it('can change the route key name', function () {
    SushiTest::setRouteKeyName('foo');
    expect((new SushiTest())->getRouteKeyName())->toBe('foo');
});

// Should Cache
it('returns correct values for shouldCache', function ($configValue, $setValue, $expectedResult) {
    config(['sushi-chef.should_cache' => $configValue]);
    SushiTest::setShouldCache($setValue);
    expect(SushiTest::getShouldCache())->toBe($expectedResult);
})->with([
    [true, null, true],
    [false, null, false],
    [true, true, true],
    [true, false, false],
]);

// Json Data
it('returns correct data from JSON file', function () {

    SushiTest::setFilePath('tests/Fixtures/blog-test.json');

    expect(SushiTest::getRowsChef())->toBeArray()->not()->toBeEmpty();
});

it('returns empty array if JSON file does not exist', function () {
    SushiTest::setFilePath('tests/Fixtures/non-existent.json');
    expect(SushiTest::getRowsChef())->toBeArray()->toBeEmpty();
});

it('returns empty array if no file path is set', function () {
    expect(SushiTest::getRowsChef())->toBeArray()->toBeEmpty();
});

it('can override row data', function () {
    SushiTest::setRows([['title' => 'Test', 'slug' => 'test']]);

    expect(SushiTest::getRowsChef())->toBeArray()->toHaveCount(1)
        ->and(SushiTest::getRowsChef())->toContain(['title' => 'Test', 'slug' => 'test']);
});

// Data Helpers
it('merges data correctly', function () {
    $jsonData = [['slug' => 'test', 'title' => 'Test']];
    $databaseData = [['slug' => 'test2', 'title' => 'Test 2']];
    $mergedData = SushiTest::mergeData($jsonData, $databaseData);
    expect($mergedData)->toHaveCount(2);
});

it('checks and modifies slugs correctly', function () {
    config(['sushi-chef.duplicate_slug_suffix' => '-test']);
    $rows = SushiTest::checkSlugs([['slug' => 'test', 'title' => 'Test'], ['title' => 'Test']]);
    expect($rows)->toHaveCount(2)
        ->and($rows[1]['slug'])->toBe(Str::slug('Test') . '-test');
});