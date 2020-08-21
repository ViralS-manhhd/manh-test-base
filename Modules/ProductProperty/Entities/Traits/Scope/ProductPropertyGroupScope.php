<?php

namespace Modules\ProductProperty\Entities\Traits\Scope;

use Modules\Core\Entities\Traits\Filterable\TranslationNameFilterable;
use Modules\ProductProperty\Entities\Traits\Filterable\ProductPropertyGroupFindUniqueFilterable;

trait ProductPropertyGroupScope
{
    use TranslationNameFilterable, ProductPropertyGroupFindUniqueFilterable;
}
