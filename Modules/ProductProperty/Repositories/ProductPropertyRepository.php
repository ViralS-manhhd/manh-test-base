<?php

namespace Modules\ProductProperty\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Repositories\BaseRepository;
use Modules\ProductProperty\Entities\ProductProperty;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyGroupRepositoryInterface;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyPriceRepositoryInterface;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyRepositoryInterface;

class ProductPropertyRepository extends BaseRepository implements ProductPropertyRepositoryInterface
{
    /**
     * @var ProductPropertyPriceRepositoryInterface
     */
    private $productPropertyPriceRepository;
    /**
     * @var ProductPropertyGroupRepositoryInterface
     */
    private $productPropertyGroupRepository;

    /**
     * ProductCategoryRepository constructor.
     * @param ProductProperty $productProperty
     * @param ProductPropertyPriceRepositoryInterface $productPropertyPriceRepository
     * @param ProductPropertyGroupRepositoryInterface $productPropertyGroupRepository
     */
    public function __construct(ProductProperty $productProperty,
                                ProductPropertyPriceRepositoryInterface $productPropertyPriceRepository,
                                ProductPropertyGroupRepositoryInterface $productPropertyGroupRepository)
    {
        $this->model = $productProperty;
        $this->productPropertyPriceRepository = $productPropertyPriceRepository;
        $this->productPropertyGroupRepository = $productPropertyGroupRepository;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $properties = json_decode($attributes['properties'], true);
        $groups = json_decode($attributes['property_groups'], true);
        $result = null;

        foreach ($groups as $gr) {
            $group = $this->findUniqueOrCreate($this->productPropertyGroupRepository, ['name' => $gr['name']]);
            foreach ($gr['properties'] as $property) {
                $property['group_id'] = $group->id;
                unset($property['id']);
                $this->findUniqueOrCreate($this, $property);
            }
        }
        foreach ($properties as $property) {
            $property['properties'] = json_encode($property['name']);
            $property['product_id'] = $attributes['product_id'];
            unset($property['name']);
            $result = $this->findUniqueOrCreate($this->productPropertyPriceRepository, $property);
        }
        return $result;
    }

    /**
     * @param $repo
     * @param $data
     * @return mixed
     */
    public function findUniqueOrCreate($repo, $data)
    {
        $model = $repo->getModel()->findUnique($data)->first();
        if (!$model) {
            $model = $repo->getModel()->create($data);
        }
        return $model;
    }
}
