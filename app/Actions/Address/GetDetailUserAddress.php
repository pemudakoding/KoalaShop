<?php

namespace App\Actions\Address;

use App\Contracts\InternalResponse;
use App\Models\UserAddress;
use App\Repositories\Address\EloquentUserAddressRepository;

class GetDetailUserAddress
{

    use InternalResponse;

    private object $userAddressRepository;

    public function __construct()
    {
        $this->userAddressRepository = new EloquentUserAddressRepository();
    }

    public function get(UserAddress|string $addressOrSlug): array
    {
        $execute = $this->execute($addressOrSlug);

        return $this->response('Successfully get detail address', $execute, 201);
    }

    private function execute(UserAddress|string $addressOrSlug): object
    {
        if (gettype($addressOrSlug) === 'string') {
            return $this->userAddressRepository->getUserAddressBySlug($addressOrSlug);
        } else {

            $address = $addressOrSlug;
            $address['user'] = $address->user;

            return $address;
        }
    }
}
