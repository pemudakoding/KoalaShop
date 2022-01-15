<?php

namespace App\Actions\Product;

use App\Abstracts\Actions\ProductBaseAction;

class GetProduct extends ProductBaseAction
{

    public function get(?int $userId = null, $request = null): array
    {
        $products = $this->execute($userId, $request);

        return $this->response('Successfully get products data', $products, 200);
    }

    public function execute($userId, $request)
    {

        $productTitle = $request->title ?? null;

        if ($userId && $productTitle)
            return $this->productRepository
                ->getByName($productTitle, $userId);

        if ($productTitle && !$userId)
            return $this->productRepository
                ->getByName($productTitle, $userId);

        if ($userId && !$productTitle)
            return $this->productRepository
                ->getByUserId($userId);

        return $this->productRepository
            ->get();
    }
}
