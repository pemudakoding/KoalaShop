<?php

namespace App\Actions\Address;

use App\Contracts\InternalResponse;
use App\Models\UserAddress;
use App\Repositories\Address\EloquentUserAddressRepository;
use Illuminate\Support\Str;

class UpdateUserAddress
{

    use InternalResponse;

    private object $userAddressRepository;

    public function __construct()
    {
        $this->userAddressRepository = new EloquentUserAddressRepository();
    }


    public function update(UserAddress|string $addressOrSlug, array $data): array
    {

        $address = $this->filterInput($addressOrSlug);
        $updateAddress = $this->execute($address, $data);

        return $this->response('Successfully updating address', $updateAddress, 200);
    }

    private function filterInput(UserAddress|string $addressOrSlug): object
    {

        if (gettype($addressOrSlug) === 'string') {
            return $this->userAddressRepository->getUserAddressBySlug($addressOrSlug);
        } else {
            return $addressOrSlug;
        }
    }

    private function execute(UserAddress $address, array $data)
    {
        $addressSlug = Str::slug($data['title'] . " " . date('jwyzhi'));
        $data['slug'] = $addressSlug;

        $this->userAddressRepository->update($address, $data);

        return ['slug' => $addressSlug];
    }
}
