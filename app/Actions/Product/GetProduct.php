<?php

namespace App\Actions\Product;

use App\Abstracts\Actions\ProductBaseAction;
use App\Models\Product;

class GetProduct extends ProductBaseAction
{

    public function get(?int $userId = null, $request = null): array
    {
        $products = $this->execute($userId, $request);

        return $this->response('Successfully get products data', $products, 200);
    }

    public function execute($userId, $request)
    {

        $productTitle = $request['title'] ?? null;

        $productInstance = Product::query();

        $productInstance->with(['productOwner']);

        if ($userId)
            $productInstance->where('user_id', $userId);

        if ($productTitle)
            $productInstance->where('name', $productTitle);

        return $productInstance->get();
    }
}
