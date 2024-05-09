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


    // Route key name
    protected string $routeKeyName = 'slug';

    public function setRouteKeyName($name): void
    {
        $this->routeKeyName = $name;
    }

    public function getRouteKeyName(): string
    {
        return $this->routeKeyName;
    }

    // Should Cache
    protected ?bool $shouldCache = null;

    protected function sushiShouldCache()
    {
        return $this->shouldCache;
    }

    public function setShouldCache($cache): void
    {
        $this->shouldCache = $cache;
    }

    public function getShouldCache()
    {
        return $this->shouldCache;
    }

    // Json File Path
    protected ?string $filePath = null;

    public function getJsonData($path = null): array
    {
        if (!$path) {
            $path = $this->filePath;
        }

        if (!file_exists($path)) {
            return [];
        }
        $rows = json_decode(file_get_contents($path), true);

        return $this->checkSlugs($rows);
    }

    public function setFilePath($path): void
    {
        $this->filePath = $path;
    }

    public function getFilePath()
    {
        return $this->filePath;
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
    protected ?array $rowData = [];

    public function setRowData(?array $data): void
    {
        $this->rowData = $data;
    }

    public function getRowData()
    {
        return $this->rowData;
    }

    public function getRows($filePath = null)
    {

        // First, check if data has been set manually (useful for testing).
        if (!empty($this->rowData)) {
            return $this->rowData;
        }

        if (empty($filePath)) {
            $filePath = $this->filePath;
        }
        if (file_exists($filePath)) {


            // Load data from the JSON file.
            $jsonData = $this->getJsonData($filePath);
            // Fetch data from the database.
            $databaseData = $this->fetchFromDatabase();

            // Assuming both sets of data are arrays of arrays, and 'slug' is the unique key
            return $this->mergeData($jsonData, $databaseData);
        }
        return [];
    }

    protected function afterMigrate(Blueprint $table)
    {
        $table->index('slug');
    }


    public function checkSlugs($rows): array
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