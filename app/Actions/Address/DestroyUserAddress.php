<?php

namespace App\Actions\Address;

use App\Abstracts\Actions\UserAddressBaseAction;
use App\Models\UserAddress;

class DestroyUserAddress extends UserAddressBaseAction
{

    public function delete(UserAddress|string $addressOrSlug): array
    {
        $address = $this->getAddress($addressOrSlug);

        return $this->execute($address);
    }

    private function getAddress(UserAddress|string $addressOrSlug): object
    {

        if (gettype($addressOrSlug) === 'string') {

            return $this->userAddressRepository->getUserAddressBySlug($addressOrSlug);
        } else {

            return $addressOrSlug;
        }
    }

    private function execute(UserAddress $address): array
    {

        $destroying = $this->userAddressRepository->delete($address);

        if ($destroying)
            return $this->response('Successfully deleted address', null, 200);
        else
            return $this->response('Failed deleting address', null, 500);
    }
}
