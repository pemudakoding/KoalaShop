<?php

namespace App\Services\Product;

use App\Actions\Product\StoreProduct;

class ProductService
{

    public function store($request): array
    {
        $productAction = (new StoreProduct)->store($request);

        return $productAction;
    }
}
