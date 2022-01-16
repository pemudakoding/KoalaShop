<?php

namespace App\Services\Order;

use App\Actions\Order\StoreOrder;
use App\Actions\Order\GenerateOrderData;
use App\Actions\Order\StoreDetailOrder;
use App\Contracts\InternalResponse;

class StoreOrderService
{
    use InternalResponse;

    public function store($orderData)
    {

        $userId = auth('sanctum')->user()->id;
        $generateOrderData = (new GenerateOrderData)->execute($orderData, $userId);
        $orderAction = (new StoreOrder)->store($generateOrderData);

        if ($orderAction)
            $orderDetailAction = (new StoreDetailOrder)->store($generateOrderData, $orderAction->id);

        if ($orderDetailAction)
            return $this->response('Successfully ordering products', $orderAction, 200);

        return $this->response('Failed ordering products', $orderAction, 500);
    }
}
