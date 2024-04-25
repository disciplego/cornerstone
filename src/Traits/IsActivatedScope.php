<?php

namespace Dgo\Cornerstone\Traits;

use Illuminate\Database\Eloquent\Builder;

trait IsActivatedScope
{
// Local scope to retrieve only activated items
    public function scopeActivated(Builder $query): void
    {
        $query->where('is_activated', true);
    }

    // Local scope to retrieve only deactivated items
    public function scopeDeactivated(Builder $query): void
    {
        $query->where('is_activated', false)
        ->orWhere('is_activated', '')
            ->orWhereNull('is_activated');
    }
}
