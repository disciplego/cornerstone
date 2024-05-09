<?php

namespace Dgo\Cornerstone\Traits;

use Dgo\BlogManager\Blog;
use Dgo\Cornerstone\Facades\SushiHelp;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Sushi\Sushi;

trait SushiChef
{
    use Sushi;

    protected static ?bool $shouldCache = null;
    protected static array $setRows = [];
    protected static ?bool $setShouldCache = null;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function sushiShouldCache($override = null)
    {
        if (!empty(self::$setShouldCache)) {
            return self::$setShouldCache;
        }
        return $override ?? self::$shouldCache;
    }

    public static function getJsonData($filePath = null)
    {
        $resolvedPath = self::resolveJsonFilePath($filePath);

        if (!file_exists($resolvedPath)) {
            return [];
        }
        $rows = json_decode(file_get_contents($resolvedPath), true);

        return self::checkSlugs($rows);
    }

    public static function setRows(array $data): void
    {
        self::$setRows = $data;
    }

    public static function setShouldCache(?bool $shouldCache): void
    {
        self::$setShouldCache = $shouldCache;
    }


    protected function afterMigrate(Blueprint $table)
    {
        $table->index('slug');
    }

    public static function getRows($filePath = null)
    {

        // First, check if data has been set manually (useful for testing).
        if (!empty(self::$setRows)) {
            return self::$setRows;
        }

        // Load data from the JSON file.
        $jsonData = self::getJsonData($filePath);
        // Fetch data from the database.
        $databaseData = self::fetchFromDatabase();

        // Assuming both sets of data are arrays of arrays, and 'slug' is the unique key
        $combinedData = self::mergeData($jsonData, $databaseData);

        return $combinedData;
    }


    public static function checkSlugs($rows)
    {
        $checkedRows = [];
        $slugs = []; // Initialize an array to track slugs
        foreach ($rows as $row) {
            if (empty($row['slug'])) {

                $row['slug'] = Str::slug($row['title']);
            }
            if (in_array($row['slug'], $slugs)) {
                $row['slug'] = $row['slug'] . '-' . config('blog-manager.blog.duplicate_slug_suffix');
            }
            $slugs[] = $row['slug'];
            $checkedRows[] = $row;
        }
        return $checkedRows;
    }

    public static function resolveJsonFilePath($filePath = null,  $userPath = null, $defaultPath = null)
    {
        if ($filePath) {
            return $filePath;
        }

        if (! $userPath) {
            $userPath = __DIR__ . '/../' . config('blog-manager.blog.json_path');
        }
        if(! $defaultPath)
        {
            $defaultPath = __DIR__ . '/../resources/json/blogs.json';  // Assuming default path in package
        }


        return file_exists($userPath) ? $userPath : $defaultPath;
    }

    public static function fetchFromDatabase()
    {
        if (!Schema::hasTable('blogs')) {
            return [];  // Return an empty array if the table does not exist
        }
        return Blog::all()->toArray();  // Convert Eloquent Collection to array
    }

    public static function mergeData(array $jsonData, array $databaseData)
    {
        // Index both datasets by 'slug'
        $jsonIndexed = collect($jsonData)->keyBy('slug')->toArray();
        $dbIndexed = collect($databaseData)->keyBy('slug')->toArray();

        // Database entries override JSON entries
        $merged = array_replace($jsonIndexed, $dbIndexed);

        return array_values($merged);  // Reset indices and return combined data
    }
}