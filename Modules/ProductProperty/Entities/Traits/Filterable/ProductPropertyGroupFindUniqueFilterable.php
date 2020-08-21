<?php

namespace Modules\ProductProperty\Entities\Traits\Filterable;

trait ProductPropertyGroupFindUniqueFilterable
{
    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function scopeFindUnique($query, $data)
    {
        return $query->whereTranslation('name', $data['name']);
    }
}
