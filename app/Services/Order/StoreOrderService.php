<?php

namespace App\Services\Order;

use App\Actions\Order\{CheckProductOrder, StoreOrder, GenerateOrderData, StoreDetailOrder};
use App\Contracts\InternalResponse;

class StoreOrderService
{
    use InternalResponse;

    public function store($orderData)
    {

        $userId = auth('sanctum')->user()->id;
        $generateOrderData = (new GenerateOrderData)->execute($orderData, $userId);

        $products = $generateOrderData['products'];
        $productsId = $this->getProductsId($products);
        $checkUserProduct = (new CheckProductOrder)->check($userId, $productsId);

        if ($checkUserProduct)
            return $this->response('Failed ordering products! Cannot ordering own products', null, 406);

        $orderAction = (new StoreOrder)->store($generateOrderData);
        if ($orderAction)
            $orderDetailAction = (new StoreDetailOrder)->store($generateOrderData, $orderAction->id);

        if ($orderDetailAction)
            return $this->response('Successfully ordering products', $orderAction, 200);

        return $this->response('Failed ordering products', null, 500);
    }

    public function getProductsId(array $products)
    {

        $productsId = [];
        foreach ($products as $product) {
            array_push($productsId, $product['product_id']);
        }

        return $productsId;
    }
}
