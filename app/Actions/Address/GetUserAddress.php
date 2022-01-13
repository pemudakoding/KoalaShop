<?php

namespace App\Actions\Address;

use App\Abstracts\Response as AbstractResponse;
use App\Contracts\InternalResponse;
use App\Models\UserAddress;

class GetUserAddress
{

    use InternalResponse;

    public function get(int $userId): array
    {

        $addresses = UserAddress::getUserAddress($userId);

        return $this->response('Successfully get addresses', $addresses, 200);
    }
}
