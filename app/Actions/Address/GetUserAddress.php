<?php

namespace App\Actions\Address;

use App\Abstracts\Actions\UserAddressBaseAction;
use App\Models\UserAddress;

class GetUserAddress  extends UserAddressBaseAction
{

    public function get(int $userId): array
    {
        $addresses = UserAddress::where('user_id', $userId)
            ->get();

        return $this->response('Successfully get addresses', $addresses, 200);
    }
}
