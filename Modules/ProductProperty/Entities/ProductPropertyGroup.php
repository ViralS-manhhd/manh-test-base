<?php

namespace Modules\ProductProperty\Entities;

use Astrotomic\Translatable\Translatable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Modules\ProductProperty\Entities\Traits\Attribute\ProductPropertyGroupAttribute;
use Modules\ProductProperty\Entities\Traits\Methods\ProductPropertyGroupMethod;
use Modules\ProductProperty\Entities\Traits\Relationship\ProductPropertyGroupRelationship;
use Modules\ProductProperty\Entities\Traits\Scope\ProductPropertyGroupScope;

class ProductPropertyGroup extends Model
{
    use Translatable, Cachable;
    use ProductPropertyGroupAttribute, ProductPropertyGroupMethod, ProductPropertyGroupRelationship, ProductPropertyGroupScope;

    protected $table = 'pro_pro_gr';
    protected $fillable = [];
    public $translatedAttributes = ['name'];
    protected $translationForeignKey = 'pro_pro_gr_id';
}
