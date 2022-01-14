<?php

namespace App\Repositories\Product;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class EloquentProductRepository implements ProductRepositoryInterface
{

    public function create(array $data): Product
    {

        return Product::create($data);
    }
}
