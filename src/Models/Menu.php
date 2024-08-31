<?php

namespace Dgo\Cornerstone\Models;

use Dgo\Cornerstone\Traits\HasSlugScope;
use Dgo\Cornerstone\Traits\IsActivatedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Menu extends Model
{
    use SoftDeletes, HasFactory, IsActivatedScope, HasSlug, HasSlugScope;

    protected $fillable = [
        'name',
        'slug',
        'is_activated',
    ];

    protected $casts = [
        'is_activated' => 'boolean',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Get the items for the menu.
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(MenuItem::class);
    }
}
