<?php

namespace Modules\ProductProperty\Entities;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class ProductPropertyTranslation extends Model
{
    use Cachable;

    protected $table = 'pro_pro_translations';
    protected $fillable = ['name'];
}
