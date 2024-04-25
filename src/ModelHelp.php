<?php

namespace Dgo\Cornerstone;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;

class ModelHelp
{
    protected Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getAllModels($namespace = 'App\\Models\\', $path = null): array
    {
        $path = $this->getPath($path);

        $models = $this->filesystem->files($path);

        return array_reduce($models, function ($accumulator, $model) use ($namespace) {
            $modelName = $namespace . basename($model, '.php');
            $accumulator[$modelName] = class_basename($modelName);

            return $accumulator;
        }, []);
    }

    /**
     * @throws ReflectionException
     */
    public function getAllModelsWithTrait($fullTraitName = null, $namespace = null, $path = null): array
    {
        $namespace = $this->getNamespace($namespace);
        $path = $this->getPath($path);
        $models = $this->getAllModels($namespace, $path);
        $traitModels = [];

        foreach ($models as $modelPath => $modelName) {
            $fullModelName = $namespace . $modelName;
            if ($this->hasTrait($fullModelName, $fullTraitName)) {
                $traitModels[$modelPath] = $modelName;
            }
        }

        return $traitModels;
    }

    public static function getModelClassByTableSlug($table, $nonPlural=false, $namespace = null): string
    {
        $namespace = 'App\\Models\\';

        if ($nonPlural ?? in_array($table, config('dgo.non_plural_tables'))) {
            return $namespace . Str::studly($table);
        }

        return $namespace . Str::studly(Str::singular($table));
    }

    public static function getPath($path = null): string
    {
        if (!$path) {
            $path = app_path('Models');
        }
        return $path;
    }

    public function getNamespace(mixed $namespace)
    {
        if (!$namespace) {
            $namespace = 'App\\Models\\';
        }
        return $namespace;
    }

    /**
     * @throws ReflectionException
     */
    public function hasTrait($fullModelName, $fullTraitName): bool
    {
        $reflection = new ReflectionClass($fullModelName);
        $traits = $reflection->getTraits();
        return array_key_exists($fullTraitName, $traits);
    }

    public static function getShortClassName(string $classPath): string
    {
        return lcfirst(class_basename($classPath));
    }

    public static function getSnakeCaseClassName(string $classPath): string
    {

        return Str::snake(class_basename($classPath));
    }

    public static function getCamelCaseClassName(string $classPath): string
    {
        return Str::camel(class_basename($classPath));
    }

    public static function getSlugCaseClassName(string $classPath): string
    {
        return Str::slug(Str::snake(class_basename($classPath)));
    }

    public static function valueToString($value, $separator = ' ', $dateFormat = 'Y-m-d'): string
    {
        if (is_array($value)) {
            return implode($separator, $value);
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } elseif ($value instanceof \DateTime) {
            return $value->format($dateFormat);
        } elseif (is_object($value)) {
            return '';
        } else {
            return (string) $value;
        }
    }

}