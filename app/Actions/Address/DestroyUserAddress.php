<?php

namespace App\Actions\Address;

use App\Contracts\InternalResponse;
use App\Models\User;
use App\Models\UserAddress;

class DestroyUserAddress
{

    use InternalResponse;

    public function delete(UserAddress|string $addressOrSlug): array
    {
        $address = $this->getAddress($addressOrSlug);

        return $this->execute($address);
    }

    private function getAddress(UserAddress|string $addressOrSlug): object
    {

        if (gettype($addressOrSlug) === 'string') {
            return UserAddress::getUserAddressBySlug($addressOrSlug);
        } else {
            return $addressOrSlug;
        }
    }

    private function execute(UserAddress $address): array
    {

        $destroying = $address->delete();

        if ($destroying)
            return $this->response('Successfully deleted address', null, 200);
        else
            return $this->response('Failed deleting address', null, 500);
    }
}
