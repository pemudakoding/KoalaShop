<?php

namespace App\Actions\Order;

use App\Models\OrderDetail;
use Carbon\Carbon;

class StoreDetailOrder
{
    public function store(array $data, int $orderId)
    {

        $orderData = collect($data);
        $products = $orderData->get('products');

        foreach ($products as $currentKey => $product) {

            $products[$currentKey]['order_id'] = $orderId;
            $products[$currentKey]['created_at'] = Carbon::now();
            $products[$currentKey]['updated_at'] = Carbon::now();
        }


        return $this->execute($products);
    }

    private function execute($data)
    {

        return OrderDetail::insert($data);
    }
}
