<?php

namespace Dgo\Cornerstone\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Childable
{
    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function listChildren(): HasMany
    {
        $columns = $this->childableColumns ?? ['id', 'slug', 'title', 'parent_id'];

        return $this->children()->select($columns)->with(['children' => function ($query) use ($columns) {
            $query->select($columns);
        }]);
    }

    public function descendants(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->with('descendants');
    }

    public function getAllDescendants($descendants = null)
    {
        if ($descendants === null) {
            $descendants = collect([]);
        }

        foreach ($this->descendants as $descendant) {
            $descendants->push($descendant);
            $descendant->getAllDescendants($descendants);
        }

        return $descendants;
    }
}
