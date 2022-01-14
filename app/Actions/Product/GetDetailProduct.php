<?php

namespace App\Actions\Product;

use App\Contracts\InternalResponse;
use App\Models\Product;
use App\Repositories\Product\EloquentProductRepository;
use Illuminate\Database\Eloquent\Builder;

class GetDetailProduct
{

    use InternalResponse;

    private EloquentProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new EloquentProductRepository;
    }

    public function get(Product|string $objectOrSlug)
    {
        $product = $this->execute($objectOrSlug);

        $httpCode = $product ? 200 : 404;
        return $this->response('Successfully get product detail', $product, $httpCode);
    }

    public function execute(Product|string $objectOrSlug): Product|Builder|null
    {

        if (gettype($objectOrSlug) === 'string') {
            $slug = $objectOrSlug;
        } else {
            $slug = $objectOrSlug->slug;
        }
        return $this->productRepository->getBySlug('sepatu-air-jordan-blue-14522131247');
    }
}
