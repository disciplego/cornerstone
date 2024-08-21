<?php

namespace Dgo\Cornerstone\Models;

use Illuminate\Database\Eloquent\Model;

class PageAbstract extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'settings' => 'array',
        'details' => 'array',
        'blocks' => 'array',
        'published_at' => 'date',
        'unpublished_at' => 'date',
        'is_activated' => 'boolean',
        'parent_id' => 'integer',
        'author_id' => 'integer',
        'pageable_id' => 'integer',
        'featured_image_id' => 'integer',
    ];
}
