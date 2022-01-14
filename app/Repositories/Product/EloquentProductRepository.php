<?php

namespace App\Repositories\Product;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\User;

class EloquentProductRepository implements ProductRepositoryInterface
{

    public function create(array $data): Product
    {

        return Product::create($data);
    }

    public function getBySlug(string $slug): Product
    {
        return Product::with(['productOwner'])
            ->where('slug', $slug)->first();
    }

    public function update(Product $productObject, $data): bool
    {

        return $productObject->update($data);
    }
}
