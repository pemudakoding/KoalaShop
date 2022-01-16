<?php

namespace App\Actions\Product;

use App\Abstracts\Actions\ProductBaseAction;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class GetDetailProduct extends ProductBaseAction
{

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
        return Product::with(['productOwner'])
            ->where('slug', $slug)
            ->first();
    }
}
