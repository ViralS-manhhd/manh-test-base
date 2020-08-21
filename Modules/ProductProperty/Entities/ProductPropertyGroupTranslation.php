<?php

namespace Modules\ProductProperty\Entities;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class ProductPropertyGroupTranslation extends Model
{
    use Cachable;

    protected $table = 'pro_pro_gr_translations';
    protected $fillable = ['name'];
}
