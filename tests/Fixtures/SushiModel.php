<?php

namespace Dgo\Cornerstone\Tests\Fixtures;

use Dgo\Cornerstone\Traits\SushiChef;
use Illuminate\Database\Eloquent\Model;

class SushiModel extends Model
{
    use SushiChef;
}
