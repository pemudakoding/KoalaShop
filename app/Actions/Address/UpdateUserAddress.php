<?php

namespace App\Actions\Address;

use App\Abstracts\Actions\UserAddressBaseAction;
use App\Models\UserAddress;
use Illuminate\Support\Str;

class UpdateUserAddress extends UserAddressBaseAction
{

    public function update(UserAddress|string $addressOrSlug, array $data): array
    {

        $address = $this->filterInput($addressOrSlug);
        $updateAddress = $this->execute($address, $data);

        return $this->response('Successfully updating address', $updateAddress, 200);
    }

    private function filterInput(UserAddress|string $addressOrSlug): object
    {

        if (gettype($addressOrSlug) === 'string') {
            return UserAddress::getAddressInstaceBySlug($addressOrSlug);
        } else {
            return $addressOrSlug;
        }
    }

    private function execute(UserAddress $address, array $data)
    {
        $addressSlug = Str::slug($data['title'] . " " . date('jwyzhi'));
        $data['slug'] = $addressSlug;

        $address->update($data);

        return ['slug' => $addressSlug];
    }
}
