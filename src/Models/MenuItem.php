<?php

namespace Dgo\Cornerstone\Models;

use Dgo\Cornerstone\Traits\HasSlugScope;
use Dgo\Cornerstone\Traits\IsActivatedScope;
use Dgo\Cornerstone\Traits\IsPublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class MenuItem extends Model implements Sortable
{
    use SoftDeletes, HasFactory, SortableTrait, IsPublishedScope, IsActivatedScope, HasSlug, HasSlugScope;

    protected $fillable = [
        'title',
        'slug',
        'abbreviation',
        'icon',
        'url',
        'route',
        'target',
        'help_text',
        'published_at',
        'unpublished_at',
        'menu_id',
        'menuable_type',
        'is_activated',
        'parent_id',
        'order_column',
    ];

    protected $casts = [
        'published_at' => 'date',
        'unpublished_at' => 'date',
        'is_activated' => 'boolean'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Get the menu for the items.
     */
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }
}
