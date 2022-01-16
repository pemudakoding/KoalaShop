<?php

namespace App\Http\Controllers\User;

use App\Contracts\ClientResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Services\Order\StoreOrderService;


class OrderController extends Controller
{

    use ClientResponse;

    public function store(StoreOrderRequest $request, StoreOrderService $orderService)
    {
        $order = $orderService->store($request->toArray());

        return $this->response($order);
    }
}
