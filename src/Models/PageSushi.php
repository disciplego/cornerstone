<?php

namespace Dgo\Cornerstone\Models;

use Dgo\Cornerstone\Contracts\PageInterface;
use Dgo\Cornerstone\Traits\HasPageAttributes;
use Dgo\Cornerstone\Traits\SushiChef;
use Illuminate\Database\Schema\Blueprint;
use Sushi\Sushi;

class PageSushi extends PageAbstract implements PageInterface
{
    use Sushi, HasPageAttributes, SushiChef;

    protected static ?string $routeKeyName = 'slug';

    protected static ?string $dataModel = Page::class;

    protected function sushiShouldCache()
    {
        return config('sushi-chef.should_cache');
    }

    public function getRows()
    {
        return $this->getRowsChef();
    }

    protected function afterMigrate(Blueprint $table): void
    {
        $this->afterMigrateChef($table);
    }
}
