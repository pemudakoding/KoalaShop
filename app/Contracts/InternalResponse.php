<?php

namespace App\Contracts;

trait InternalResponse
{

    public function response(string $msg, mixed $data, int $httpStatus): array
    {
        return [
            'msg' => $msg,
            'code' => $httpStatus,
            'data' => $data
        ];
    }
}
