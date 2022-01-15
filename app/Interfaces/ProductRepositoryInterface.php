<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{

    public function create(array $data);
    public function get();
    public function getByName(string $title, int $userId);
    public function getByUserId(int $userId);
    public function getBySlug(string $slug);
    public function update(Product $productObject, array $data): bool;
}
