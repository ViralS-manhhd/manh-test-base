<?php

namespace Modules\ProductProperty\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\ProductProperty\Entities\ProductPropertyGroup;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyGroupRepositoryInterface;

class ProductPropertyGroupRepository extends BaseRepository implements ProductPropertyGroupRepositoryInterface
{
    /**
     * ProductCategoryRepository constructor.
     * @param ProductPropertyGroup $productPropertyGroup
     */
    public function __construct(ProductPropertyGroup $productPropertyGroup)
    {
        $this->model = $productPropertyGroup;
    }
}
