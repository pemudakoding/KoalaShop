<?php

namespace App\Actions\Product;

use App\Abstracts\Actions\ProductBaseAction;
use App\Models\Product;
use Illuminate\Support\Str;

class UpdateProduct extends ProductBaseAction
{

    public function update(Product|string $productObjectOrSlug, array $data): array
    {

        $product = $this->getProduct($productObjectOrSlug);

        if ($product) {

            $update = $this->execute($product, $data);
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

        return Product::getInstanceBySlug($slug);
    }

    private function execute(Product $product, $data): array
    {
        $slug = Str::slug($data['name'] . " " . date('jwyzhi'));

        $data['slug'] = $slug;
        return [
            'slug' => $slug,
            'status' => $product->update($data)
        ];
    }
}
