<?php

namespace Modules\ProductProperty\Entities\Traits\Filterable;

trait ProductPropertyPriceFindUniqueFilterable
{
    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function scopeFindUnique($query, $data)
    {
        return $query->where('product_id', $data['product_id']);
    }
}
