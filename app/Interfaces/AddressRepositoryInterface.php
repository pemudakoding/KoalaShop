<?php

namespace App\Interfaces;

use App\Models\UserAddress;


interface AddressRepositoryInterface
{
    public function getUserAddress(int $userId): object;
    public function getUserAddressBySlug(string $slug): UserAddress|null;
    public function create(array $data): object;
    public function update(UserAddress|int $objectOrId, array $dataWillUpdate): bool;
    public function delete(UserAddress|int $objectOrId): bool;
}
