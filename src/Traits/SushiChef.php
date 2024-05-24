<?php

namespace Dgo\Cornerstone\Traits;

use Dgo\BlogManager\Blog;
use Dgo\Cornerstone\Facades\SushiHelp;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait SushiChef
{
    
    // Route key name
protected static ?string $routeKeyName = 'slug';

    protected function afterMigrateChef(Blueprint $table): void
    {
        $table->index(self::$routeKeyName);
    }

    public static function setRouteKeyName($name = null): void
    {
        if(!$name) {
            self::$routeKeyName = config('sushi-chef.route_key_name', 'slug');
        }
        self::$routeKeyName = $name;
    }

    public function getRouteKeyName(): string
    {
        return self::$routeKeyName;
    }

    // Should Cache
    protected static ?bool $shouldCache = null;

    protected function sushiShouldCacheChef()
    {
        return $this->shouldCache;
    }

    public static function setShouldCache($cache): void
    {
        self::$shouldCache = $cache;
    }

    public static function getShouldCache()
    {
        return self::$shouldCache ?? config('sushi-chef.should_cache');
    }

    // Json File Path
    protected static ?string $filePath = null;

    public static function getJsonData($path = null): array
    {
        if (!$path) {
            $path = self::$filePath;
        }

        if (!file_exists($path)) {
            return [];
        }
        $rows = json_decode(file_get_contents($path), true);

        return self::checkSlugs($rows);
    }

    public static function setFilePath($path): void
    {
        self::$filePath = $path;
    }

    public static function getFilePath()
    {
        return self::$filePath;
    }

    public function resolveJsonFilePath($filePath = null, $userPath = null, $defaultPath = null)
    {
        if ($filePath) {
            return $filePath;
        }

        if (!$userPath) {
            $userPath = __DIR__ . '/../' . config('blog-manager.blog.json_path');
        }
        if (!$defaultPath) {
            $defaultPath = __DIR__ . '/../resources/json/blogs.json';  // Assuming default path in package
        }


        return file_exists($userPath) ? $userPath : $defaultPath;
    }

    // Rows
    protected static array $rows = [];

    public static function setRows($rowData =[]): void
    {
        self::$rows = $rowData;
    }



    public static function getRowsChef()
    {

        if (file_exists(self::$filePath)) {


            // Load data from the JSON file.
            $jsonData = self::getJsonData(self::$filePath);
            // Fetch data from the database.
            $databaseData = self::fetchFromDatabase();

            // Assuming both sets of data are arrays of arrays, and 'slug' is the unique key
            return self::mergeData($jsonData, $databaseData);
        }
        return self::$rows;
    }


    public static function checkSlugs($rows): array
    {
        $checkedRows = [];
        $slugs = []; // Initialize an array to track slugs
        foreach ($rows as $row) {
            if (empty($row['slug'])) {

                $row['slug'] = Str::slug($row['title']);
            }
            if (in_array($row['slug'], $slugs)) {
                $row['slug'] = $row['slug'] . config('sushi-chef.duplicate_slug_suffix', '-1');
            }
            $slugs[] = $row['slug'];
            $checkedRows[] = $row;
        }
        return $checkedRows;
    }


    public static function fetchFromDatabase(): array
    {
        if (!Schema::hasTable('blogs')) {
            return [];  // Return an empty array if the table does not exist
        }
        return self::all()->toArray();  // Convert Eloquent Collection to array
    }

    public static function mergeData(array $jsonData, array $databaseData): array
    {
        // Index both datasets by 'slug'
        $jsonIndexed = collect($jsonData)->keyBy('slug')->toArray();
        $dbIndexed = collect($databaseData)->keyBy('slug')->toArray();

        // Database entries override JSON entries
        $merged = array_replace($jsonIndexed, $dbIndexed);

        return array_values($merged);  // Reset indices and return combined data
    }
}