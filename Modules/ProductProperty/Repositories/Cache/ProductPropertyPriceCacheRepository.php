<?php

namespace Modules\ProductProperty\Repositories\Cache;

use Illuminate\Cache\CacheManager;
use Modules\Core\Repositories\Cache\BaseCacheRepository;
use Modules\ProductProperty\Entities\ProductPropertyPrice;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyPriceRepositoryInterface;
use Modules\ProductProperty\Repositories\ProductPropertyPriceRepository;

class ProductPropertyPriceCacheRepository extends BaseCacheRepository implements ProductPropertyPriceRepositoryInterface
{
    /**
     * ProductCategoryCacheRepository constructor.
     * @param ProductPropertyPrice $productPropertyPrice
     * @param CacheManager $cache
     * @param ProductPropertyPriceRepository $productPropertyPriceRepository
     */
    public function __construct(ProductPropertyPrice $productPropertyPrice, CacheManager $cache, ProductPropertyPriceRepository $productPropertyPriceRepository)
    {
        $this->model = $productPropertyPrice;
        $this->cache = $cache;
        parent::__construct($productPropertyPriceRepository);
    }
}
