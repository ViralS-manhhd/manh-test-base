<?php

namespace Modules\ProductProperty\Entities;

use Astrotomic\Translatable\Translatable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Modules\ProductProperty\Entities\Traits\Attribute\ProductPropertyAttribute;
use Modules\ProductProperty\Entities\Traits\Methods\ProductPropertyMethod;
use Modules\ProductProperty\Entities\Traits\Relationship\ProductPropertyRelationship;
use Modules\ProductProperty\Entities\Traits\Scope\ProductPropertyScope;

class ProductProperty extends Model
{
    use Translatable, Cachable;
    use ProductPropertyAttribute, ProductPropertyMethod, ProductPropertyRelationship, ProductPropertyScope;

    protected $table = 'pro_pro';
    protected $fillable = ['group_id'];
    public $translatedAttributes = ['name'];
    protected $translationForeignKey = 'pro_pro_id';

}
