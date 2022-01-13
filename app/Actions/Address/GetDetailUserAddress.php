<?php

namespace App\Actions\Address;

use App\Contracts\InternalResponse;
use App\Models\UserAddress;

class GetDetailUserAddress
{

    use InternalResponse;
    public function get(UserAddress|string $addressOrSlug): array
    {
        $execute = $this->execute($addressOrSlug);

        return $this->response('Successfully get detail address', $execute, 201);
    }

    private function execute(UserAddress|string $addressOrSlug): object
    {
        if (gettype($addressOrSlug) === 'string') {
            return UserAddress::getUserAddressBySlug($addressOrSlug);
        } else {

            $address = $addressOrSlug;
            $address['user'] = $address->user;

            return $address;
        }
    }
}
