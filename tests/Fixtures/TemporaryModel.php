<?php
namespace Dgo\Cornerstone\Tests\Fixtures;

use Dgo\Cornerstone\Traits\HasTitleIdentifier;
use Dgo\Cornerstone\Traits\IsPublishedScope;
use Dgo\Cornerstone\Traits\HasSlugScope;
use Dgo\Cornerstone\Traits\IsActivatedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryModel extends Model {

    use HasSlugScope;
    use HasFactory;
    use IsActivatedScope;
    use IsPublishedScope;
    use HasTitleIdentifier;

    protected $table = 'temporary_models';

    protected $fillable = [
        'slug',
        'is_activated',
        'published_at',
        'unpublished_at',
        'title',
        'parent_id'
    ];

    protected $casts = [
        'is_activated' => 'boolean',
        'published_at' => 'date',
        'unpublished_at' => 'date',
    ];

}
