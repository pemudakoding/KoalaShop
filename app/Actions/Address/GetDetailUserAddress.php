<?php

namespace App\Actions\Address;

use App\Abstracts\Actions\UserAddressBaseAction;
use App\Models\UserAddress;

class GetDetailUserAddress extends UserAddressBaseAction
{

    public function get(UserAddress|string $addressOrSlug): array
    {
        $execute = $this->execute($addressOrSlug);

        return $this->response('Successfully get detail address', $execute, 201);
    }

    private function execute(UserAddress|string $addressOrSlug): object
    {
        if (gettype($addressOrSlug) === 'string') {
            return UserAddress::getAddressBySlug($addressOrSlug);
        } else {

            $address = $addressOrSlug;
            $address['user'] = $address->user;

            return $address;
        }
    }
}
