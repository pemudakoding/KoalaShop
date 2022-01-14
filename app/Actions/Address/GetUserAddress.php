<?php

namespace App\Actions\Address;

use App\Abstracts\Actions\UserAddressBaseAction;

class GetUserAddress  extends UserAddressBaseAction
{

    public function get(int $userId): array
    {

        $addresses = $this->userAddressRepository->getUserAddress($userId);

        return $this->response('Successfully get addresses', $addresses, 200);
    }
}
