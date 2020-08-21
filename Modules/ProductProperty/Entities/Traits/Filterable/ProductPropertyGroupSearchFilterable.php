<?php

namespace Modules\ProductProperty\Entities\Traits\Filterable;

trait ProductPropertyGroupSearchFilterable
{
    public function scopeSearch($query, $keyword)
    {
        return $query->name($keyword);
    }
}
