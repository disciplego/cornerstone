<?php

use Illuminate\Filesystem\Filesystem;
use \Dgo\Cornerstone\Facades\ModelHelp;

trait DummyTrait
{
}

class ModelWithTrait
{
    use DummyTrait;
}

class ModelWithoutTrait
{
}

it('gets all models from a given path', function () {
    \ModelHelp::shouldReceive('getAllModels')
        ->once()
        ->andReturn([
            'App\\Models\\User' => 'User',
            'App\\Models\\Post' => 'Post',
        ]);

    $models = \ModelHelp::getAllModels();

    expect($models)->toEqual([
        'App\\Models\\User' => 'User',
        'App\\Models\\Post' => 'Post',
    ]);
});


it('gets all models with a specific trait from a given path', function () {
    $mock = Mockery::mock(Filesystem::class);
    $mock->shouldReceive('files')
        ->once()
        ->andReturn([
            'App/Models/User.php',
            'App/Models/Post.php',
        ]);

    $modelHelp = Mockery::mock(Dgo\Cornerstone\ModelHelp::class, [$mock])
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();

    $modelHelp->shouldReceive('hasTrait')
        ->with('App\\Models\\User', 'SomeTrait')
        ->andReturn(true);

    $modelHelp->shouldReceive('hasTrait')
        ->with('App\\Models\\Post', 'SomeTrait')
        ->andReturn(false);

    $models = $modelHelp->getAllModelsWithTrait('SomeTrait');

    expect($models)->toEqual([
        'App\\Models\\User' => 'User'
    ]);
});

it('checks if a model has a specific trait', function () {


    // Test with a model that has the trait
        $hasTrait = ModelHelp::hasTrait(ModelWithTrait::class, DummyTrait::class);
        expect($hasTrait)->toBeTrue();


    // Test with a model that doesn't have the trait
        $hasTrait = ModelHelp::hasTrait(ModelWithoutTrait::class, DummyTrait::class);
        expect($hasTrait)->toBeFalse();
});

it('returns the model class name based on the table slug', function () {
    // Test with a regular table name
    $tableSlug1 = 'users';
    $expectedModelClass1 = 'App\Models\User';

    // Test with a table name that has no plural
    $tableSlug2 = 'dbs';
    $expectedModelClass2 = 'App\Models\Dbs';

    // Check if the function returns the correct model class names
    expect(\ModelHelp::getModelClassByTableSlug($tableSlug1))->toBe($expectedModelClass1)
        ->and(\ModelHelp::getModelClassByTableSlug($tableSlug2, [$tableSlug2, true]))->toBe($expectedModelClass2);
});

it('converts values to strings', function ($value, $expected) {
    expect(\ModelHelp::valueToString($value))->toBe($expected);
})->with(
    [
        [1, '1'],
        [1.5, '1.5'],
        [true, 'true'],
        [false, 'false'],
        [null, ''],
        ['string', 'string'],
        [new stdClass(), ''],
        [[], ''],
        [[1, 2, 3], '1 2 3'],
        [['foo', 'bar'], 'foo bar'],
        [['foo' => 'bar'], 'bar'],
        [new DateTime('2023-01-01'), '2023-01-01'],
    ]
);

it('can change the separator', function () {
    $value = [1, 2, 3];
    $expected = '1, 2, 3';

    expect(\ModelHelp::valueToString($value, ', '))->toBe($expected);
});

it('can change the datetime format', function () {
    $value = new DateTime('2023-01-01');
    $expected = '01-01-2023';

    expect(\ModelHelp::valueToString($value, ' ', 'd-m-Y'))->toBe($expected);
});