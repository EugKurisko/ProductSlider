<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct
    (
        ProductService $productService
    )
    {
        $this->productService = $productService;
    }

    /**
     * @return array|mixed
     */
    public function allProducts()
    {
        return $this->productService->all();
    }

    /**
     * @param int $id
     * @return array|mixed
     */
    public function getProduct(int $id)
    {
        return $this->productService->getProduct($id);
    }
}
