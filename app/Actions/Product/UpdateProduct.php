<?php

namespace App\Actions\Product;

use App\Contracts\InternalResponse;
use App\Models\Product;
use App\Repositories\Product\EloquentProductRepository;
use Illuminate\Support\Str;

class UpdateProduct
{

    private EloquentProductRepository $productRepository;

    use InternalResponse;

    public function __construct()
    {
        $this->productRepository = new EloquentProductRepository();
    }

    public function update(Product|string $productObjectOrSlug, object $request): array
    {

        $product = $this->getProduct($productObjectOrSlug);

        if ($product) {

            $update = $this->execute($product, $request);
            return $this->response('Successfully updating product data!', $update, 200);
        }

        return $this->response('Failed updating product data! data not found', false, 404);
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

    private function execute(Product $product, object $request): array
    {
        $slug = Str::slug($request->name . " " . date('jwyzhi'));

        $data = $request->all();
        $data['slug'] = $slug;

        return [
            'slug' => $slug,
            'status' => $product->update($data)
        ];
    }
}
