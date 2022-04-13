<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProductService extends MainService
{
    /**
     * @var string
     */
    protected $productsUrl;

    /**
     * @var string
     */
    protected $productUrl;
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->productsUrl = 'https://integrations.yaxint.com/api/products';
        $this->productUrl = 'https://integrations.yaxint.com/api/product';
    }

    /**
     * @return array|mixed
     */
    public function all()
    {
        $products = Http::withToken( config('app.token'))
            ->get($this->productsUrl,
                [
                    $this->headers,
                    'query' => [
                        'orderBy'=> 'name',
                        'page'=> '1',
                        'limit'=> '20',
                        'product_field_name'=> 'axpol',
                        'with_variants'=> '1',
                        'with_categories'=> '1',
                        'with_prints'=> '1',
                        'with_stock'=> '1',
                    ],
                ])->json();

        $this->modifyLinkImages($products['data']);

        return $products;
    }

    /**
     * @param int $id
     * @return array|mixed
     */
    public function getProduct(int $id)
    {
        return Http::withToken( config('app.token'))
            ->get($this->productUrl . "/" . $id,
                [
                    $this->headers,
                ])->json();
    }

    /**
     * @param array $images
     * @return array
     */
    private function modifyLinks(array $images): array
    {
        foreach ($images as &$image) {
            $image = str_replace('https', 'http', $image);
        }

        return $images;
    }

    /**
     * @param array $products
     * @return void
     */
    private function modifyLinkImages(array &$products)
    {
        foreach($products as &$product) {
            $product['images'] = $this->modifyLinks($product['images']);
            $product['main_image'] = str_replace('https', 'http', $product['main_image']);
        }
    }
}
