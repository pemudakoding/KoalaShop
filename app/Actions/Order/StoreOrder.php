<?php

namespace App\Actions\Order;

use App\Abstracts\Actions\OrderBaseAction;
use App\Models\Order;

class StoreOrder extends OrderBaseAction
{

    private string
        $Firstprefix = 'SMJ',
        $lastPrefix = 'CPT';

    public function store(array $data)
    {
        $order = $this->execute($data);


        return $order;
    }

    private function execute(array $data)
    {
        $orderDataCollection = collect($data);
        $orderData = $orderDataCollection->only(['address_id', 'grand_total', 'user_id']);
        $invoiceNumber = $this->generateInvoiceNumber($orderData->get('user_id'));

        $orderData->put('invoice_number', $invoiceNumber);

        return Order::create($orderData->toArray());
    }

    private function generateInvoiceNumber(int $userId)
    {
        $invoiceNumber = $this->Firstprefix . "-" . $userId . date('tnBGisv') . '-' . $this->lastPrefix;

        return $invoiceNumber;
    }
}
