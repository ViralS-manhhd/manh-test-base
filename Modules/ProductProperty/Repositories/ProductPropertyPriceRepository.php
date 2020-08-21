<?php

namespace Modules\ProductProperty\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\ProductProperty\Entities\ProductPropertyPrice;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyPriceRepositoryInterface;

class ProductPropertyPriceRepository extends BaseRepository implements ProductPropertyPriceRepositoryInterface
{
    /**
     * ProductCategoryRepository constructor.
     * @param ProductPropertyPrice $productProperty
     */
    public function __construct(ProductPropertyPrice $productProperty)
    {
        $this->model = $productProperty;
    }
}
