<?php

namespace Modules\ProductProperty\Entities;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Modules\ProductProperty\Entities\Traits\Attribute\ProductPropertyPriceAttribute;
use Modules\ProductProperty\Entities\Traits\Methods\ProductPropertyPriceMethod;
use Modules\ProductProperty\Entities\Traits\Relationship\ProductPropertyPriceRelationship;
use Modules\ProductProperty\Entities\Traits\Scope\ProductPropertyPriceScope;

class ProductPropertyPrice extends Model
{
    use Cachable;
    use ProductPropertyPriceAttribute, ProductPropertyPriceMethod, ProductPropertyPriceRelationship, ProductPropertyPriceScope;

    protected $table = 'pro_pro_prices';
    protected $fillable = ['properties', 'product_id', 'price', 'sku'];
}
