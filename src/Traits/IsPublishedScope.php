<?php

namespace Dgo\Cornerstone\Traits;

use Dgo\Cornerstone\Traits\IsActivatedScope;
use Illuminate\Database\Eloquent\Builder;

trait IsPublishedScope
{
    use IsActivatedScope;

// Local scope to retrieve only published items
    public function scopePublished(Builder $query): void
    {
        $query->where(function ($query) {
            $query->where('is_activated', true)
                ->where(function ($query) {
                    $query->where('published_at', '<=', now())
                        ->orWhereNull('published_at');
                })
                ->where(function ($query) {
                    $query->where('unpublished_at', '>', now())
                        ->orWhereNull('unpublished_at');
                });
        });
    }


    // Local scope to retrieve only unpublished items
    public function scopeUnpublished(Builder $query): void
    {
        $query->where(function ($query) {
            $query->where('is_activated', false)
                ->orWhere(function ($query) {
                    $query->where('published_at', '>', now())
                        ->orWhereNull('published_at');
                })
                ->orWhere('unpublished_at', '<', now());
        });
    }

}
