<?php

namespace Modules\ProductProperty\Entities\Traits\Filterable;

trait ProductPropertyFindUniqueFilterable
{
    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function scopeFindUnique($query, $data)
    {
        return $query->whereTranslation('name', $data['name'])->where('group_id', $data['group_id']);
    }
}
