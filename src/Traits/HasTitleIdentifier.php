<?php

namespace Dgo\Cornerstone\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasTitleIdentifier
{

    public function getCustomTitleIdentifier(): string
    {
        return 'title';
    }


    public function titleIdentifier(): Attribute
    {
        $titleIdentifier = $this->getCustomTitleIdentifier() ?? 'title';

        return Attribute::make(
            get: fn($value) => $titleIdentifier,
            set: fn($value) => $titleIdentifier,
        );
    }
}