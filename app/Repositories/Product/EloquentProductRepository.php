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

    public function get()
    {
        return Product::with(['productOwner'])
            ->get();
    }

    public function getByName(string $title, int $userId = null)
    {
        $productQuery = Product::query();
        $productQuery->with(['productOwner']);

        if ($userId)
            $productQuery->where('user_id', $userId);

        $productQuery
            ->where('name', 'LIKE', "%$title%");


        return $productQuery->get();
    }

    public function getByUserId(int $userId)
    {

        return Product::with(['productOwner'])
            ->where('user_id', $userId)
            ->get();
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
