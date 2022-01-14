<?php

namespace App\Actions\Product;

use App\Contracts\InternalResponse;
use App\Models\Product;
use App\Repositories\Product\EloquentProductRepository;

class DestroyProduct
{

    use InternalResponse;

    private EloquentProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new EloquentProductRepository;
    }

    public function delete(Product|string $productObjectOrSlug): array
    {
        $product = $this->getProduct($productObjectOrSlug);

        if ($product) {

            $deleting = $this->execute($product);
            return $this->response('Successfully deleting product', $deleting, 200);
        }

        return $this->response('Failed deleting product! Product not found', false, 404);
    }

    private function getProduct(Product|string $productObjectOrSlug): Product|null
    {
        if (gettype($productObjectOrSlug) === 'string') {
            $slug = $productObjectOrSlug;
        } else {
            $slug = $productObjectOrSlug->slug;
        }

        return $this->productRepository->getBySlug($slug);
    }

    private function execute(Product $product): bool|null
    {

        return $product->delete();
    }
}
