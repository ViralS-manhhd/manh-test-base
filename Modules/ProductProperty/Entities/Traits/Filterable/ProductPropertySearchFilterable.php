<?php

namespace Modules\ProductProperty\Entities\Traits\Filterable;

trait ProductPropertySearchFilterable
{
    public function scopeSearch($query, $keyword)
    {
        return $query->name($keyword);
    }
}
