<?php

namespace Modules\ProductProperty\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Exceptions\RepositoryException;
use Modules\Core\Http\Controllers\Controller;
use Modules\Product\Repositories\Contracts\ProductRepositoryInterface;
use Modules\ProductProperty\Http\Requests\CreateProductPropertyRequest;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyPriceRepositoryInterface;
use Modules\ProductProperty\Repositories\Contracts\ProductPropertyRepositoryInterface;

class ProductPropertyApiController extends Controller
{
    /**
     * @var ProductPropertyRepositoryInterface
     */
    private $productPropertyRepository;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var ProductPropertyPriceRepositoryInterface
     */
    private $productPropertyPriceRepository;

    public function __construct(ProductPropertyRepositoryInterface $productPropertyRepository,
                                ProductRepositoryInterface $productRepository,
                                ProductPropertyPriceRepositoryInterface $productPropertyPriceRepository)
    {
        $this->productPropertyRepository = $productPropertyRepository;
        $this->productRepository = $productRepository;
        $this->productPropertyPriceRepository = $productPropertyPriceRepository;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productProperties = $this->genPagination($request, $this->productPropertyRepository);
        return view('productproperty::product-properties.index', compact('productProperties'));
    }
}
