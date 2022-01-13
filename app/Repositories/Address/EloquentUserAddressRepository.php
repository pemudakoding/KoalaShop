<?php

namespace App\Repositories\Address;

use App\Interfaces\AddressRepositoryInterface;
use App\Models\UserAddress;

class EloquentUserAddressRepository implements AddressRepositoryInterface
{


    public function getUserAddress(int $userId): object
    {
        return UserAddress::where('user_id', $userId)->get();
    }

    public function getUserAddressBySlug(string $slug): UserAddress|null
    {
        return UserAddress::with('user')
            ->where('slug', $slug)
            ->first();
    }

    public function create(array $data): object
    {
        return UserAddress::create($data);
    }


    public function update(UserAddress|int $objectOrId, array $dataWillUpdate): bool
    {

        if (gettype($objectOrId) === 'int') {
            $address = UserAddress::find($objectOrId);
        } else {
            $address = $objectOrId;
        }

        return $address->update($dataWillUpdate);
    }
    public function delete(UserAddress|int $objectOrId): bool
    {
        if (gettype($objectOrId) === 'int') {
            $address = UserAddress::find($objectOrId);
        } else {
            $address = $objectOrId;
        }

        return $address->delete();
    }
}
