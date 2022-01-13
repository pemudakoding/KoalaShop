<?php

namespace App\Actions\Address;

use App\Contracts\InternalResponse;
use App\Models\UserAddress;
use App\Repositories\Address\EloquentUserAddressRepository;

class DestroyUserAddress
{

    use InternalResponse;

    private object $userAddressRepository;

    public function __construct()
    {
        $this->userAddressRepository = new EloquentUserAddressRepository();
    }

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
