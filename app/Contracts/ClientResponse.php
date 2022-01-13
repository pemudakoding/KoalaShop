<?php

namespace App\Contracts;

trait ClientResponse
{

    private $responseHeaders = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];

    public function response(mixed $data): object
    {
        return response()
            ->json($data, $data['code'], $this->responseHeaders);
    }
}
