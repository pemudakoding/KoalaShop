<?php

namespace App\Actions\Order;

use App\Models\Product;

class GenerateOrderData
{

    public function execute(array $data, ?int $userId)
    {
        $products = $data['products'];
        $grandTotal = 0;
        foreach ($products as $currentProductKey => $product) {

            $currentProduct = Product::getProductPrice($product['product_id']);

            $products[$currentProductKey]['sub_total'] = $currentProduct->price * $product['stocks'];
            $grandTotal += $products[$currentProductKey]['sub_total'];
        }

        $orderData = [
            'address_id' => $data['address_id'],
            'products' => $products,
            'grand_total' => $grandTotal
        ];

        if ($userId)
            $orderData['user_id'] = $userId;

        return $orderData;
    }
}
