<?php

namespace App\Abstracts;

abstract class Response
{

    protected function InternalResponse(string $msg, array $data, int $httpStatus): array
    {
        return [
            'msg' => $msg,
            'code' => $httpStatus,
            'data' => $data
        ];
    }
}
