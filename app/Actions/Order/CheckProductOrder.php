<?php

namespace App\Actions\Order;

use App\Models\Product;

class CheckProductOrder
{
    public function check($userId, array|int $productId)
    {
        return $this->getTotalProduct($userId, $productId);
    }

    private function getTotalProduct($productId, $userId)
    {
        $productInstance = Product::query();

        if (gettype($productId) === 'int')
            $productInstance->whereIn('id', $productId);
        else
            $productInstance->where('id', $productId);

        return $productInstance
            ->where('user_id', $userId)
            ->count();
    }
}
