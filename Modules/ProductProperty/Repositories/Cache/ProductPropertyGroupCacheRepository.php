<?php

namespace Modules\ProductProperty\Repositories\Cache;

use Illuminate\Cache\CacheManager;
use Modules\Core\Repositories\Cache\BaseCacheRepository;
use Modules\ProductProperty\Entities\ProductPropertyGroup;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyGroupRepositoryInterface;
use Modules\ProductProperty\Repositories\ProductPropertyGroupRepository;

class ProductPropertyGroupCacheRepository extends BaseCacheRepository implements ProductPropertyGroupRepositoryInterface
{
    /**
     * ProductCategoryCacheRepository constructor.
     * @param ProductPropertyGroup $productPropertyGroup
     * @param CacheManager $cache
     * @param ProductPropertyGroupRepository $productPropertyGroupRepository
     */
    public function __construct(ProductPropertyGroup $productPropertyGroup, CacheManager $cache, ProductPropertyGroupRepository $productPropertyGroupRepository)
    {
        $this->model = $productPropertyGroup;
        $this->cache = $cache;
        parent::__construct($productPropertyGroupRepository);
    }
}
