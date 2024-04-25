<?php

namespace Dgo\Cornerstone\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSlugScope
{
// Local scope to retrieve slug
    public function scopeSlug(Builder $query, string $slug): void
    {
        $query->where('slug', $slug);
    }
}
