<?php

namespace Dgo\Cornerstone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getAllModels(string $namespace = 'App\\Models\\', string|null $path = null)
 * @method static array getAllModelsWithTrait(string|null $fullTraitName = null, string|null $namespace = null, string|null $path = null)
 * @method static string getModelClassByTableSlug(string $table, bool $nonPlural = false, string|null $namespace = null)
 * @method static string getPath(string|null $path = null)
 * @method static string getNamespace(mixed $namespace)
 * @method static bool hasTrait(string $fullModelName, string $fullTraitName)
 * @method static string getShortClassName(string $classPath)
 * @method static string getSnakeCaseClassName(string $classPath)
 * @method static string getCamelCaseClassName(string $classPath)
 * @method static string getSlugCaseClassName(string $classPath)
 * @method static string valueToString(mixed $value, string $separator = ' ', string $dateFormat = 'Y-m-d')
 */
class ModelHelp extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'model-help';
    }
}
