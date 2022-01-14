<?php

namespace App\Actions\Address;

use App\Abstracts\Actions\UserAddressBaseAction;
use Illuminate\Support\Str;

class StoreAddress extends UserAddressBaseAction
{

    public function store($request): bool|array
    {
        $userId = $request->user()->id;

        $requestBody = $request->only(['title', 'address']);
        $requestBody['slug'] = Str::slug($requestBody['title']);
        $requestBody['user_id'] = $userId;

        return $this->execute($requestBody);
    }

    private function execute(array $data): array
    {
        $address = $this->userAddressRepository->getUserAddressBySlug($data['slug']);

        if ($address) {
            return $this->response('Failed create duplicate address', null, 400);
        }

        $address = $this->userAddressRepository->create($data);

        return $this->response(
            'Successfully creating address',
            [
                'name' => auth('sanctum')->user()->name,
                'address_title' => $address->title,
            ],
            200
        );
    }
}
