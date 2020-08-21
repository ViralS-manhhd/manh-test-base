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

class ProductPropertyController extends Controller
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

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $groups = $this->productPropertyRepository->toArrayWithNone('id', 'name');
        $products = $this->productPropertyRepository->toArrayWithNone('id', 'name');
        return view('productproperty::product-properties.create', compact('groups', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateProductPropertyRequest $request
     * @return Response
     * @throws RepositoryException
     */
    public function store(CreateProductPropertyRequest $request)
    {
        $this->removeIfZero($request, "product_id");
        $this->productPropertyRepository->create($request->except('_token'));

        return redirect()->route('product-properties.index')
            ->with(config('core.session_success'), _t('pro_pro') . ' ' . _t('create_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('productproperty::product-properties.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('productproperty::product-properties.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
