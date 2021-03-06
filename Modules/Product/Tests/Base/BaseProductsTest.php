<?php

namespace Modules\Product\Tests\Base;

use Modules\Core\Tests\TestCase;
use Modules\Product\Entities\Product;

class BaseProductsTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->index_route = 'products.index';
        $this->create_form_route = 'products.create';
        $this->store_route = 'products.store';
        $this->edit_form_route = 'products.edit';
        $this->update_route = 'products.update';
        $this->destroy_route = 'products.destroy';
    }

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->entity = create(Product::class);
    }
}
