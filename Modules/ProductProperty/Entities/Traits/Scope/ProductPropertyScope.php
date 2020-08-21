<?php

namespace Modules\ProductProperty\Entities\Traits\Scope;

use Modules\Core\Entities\Traits\Filterable\TranslationNameFilterable;
use Modules\ProductProperty\Entities\Traits\Filterable\ProductPropertyFindUniqueFilterable;

trait ProductPropertyScope
{
    use TranslationNameFilterable, ProductPropertyFindUniqueFilterable;
}
