<?php

namespace Modules\ProductProperty\Repositories\Cache;

use Illuminate\Cache\CacheManager;
use Modules\Core\Repositories\Cache\BaseCacheRepository;
use Modules\ProductProperty\Repositories\ProductPropertyRepository;
use Modules\ProductProperty\Entities\ProductProperty;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyRepositoryInterface;

class ProductPropertyCacheRepository extends BaseCacheRepository implements ProductPropertyRepositoryInterface
{
    /**
     * ProductCategoryCacheRepository constructor.
     * @param ProductProperty $productProperty
     * @param CacheManager $cache
     * @param ProductPropertyRepository $productPropertyRepository
     */
    public function __construct(ProductProperty $productProperty, CacheManager $cache, ProductPropertyRepository $productPropertyRepository)
    {
        $this->model = $productProperty;
        $this->cache = $cache;
        parent::__construct($productPropertyRepository);
    }
}
