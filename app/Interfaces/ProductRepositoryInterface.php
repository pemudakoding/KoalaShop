<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{

    public function create(array $data): Product;
    public function getBySlug(string $slug): Product;
}
