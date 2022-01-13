<?php

namespace App\Contracts;

trait InternalResponse
{

    public function response(string $msg, array|object $data, int $httpStatus): array
    {
        return [
            'msg' => $msg,
            'code' => $httpStatus,
            'data' => $data
        ];
    }
}
