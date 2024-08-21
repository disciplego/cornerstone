<?php

namespace Dgo\Cornerstone\Models;

use Dgo\Cornerstone\Contracts\PageInterface;
use Dgo\Cornerstone\Traits\HasPageAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends PageAbstract implements PageInterface
{
    use SoftDeletes, HasFactory, HasPageAttributes;


}
