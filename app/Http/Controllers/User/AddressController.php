<?php

namespace App\Http\Controllers\User;

use App\Actions\Address\{DestroyUserAddress, GetDetailUserAddress, StoreAddress, GetUserAddress};
use App\Contracts\ClientResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreAddressRequest;
use App\Models\UserAddress;


class AddressController extends Controller
{

    use ClientResponse;

    public function index(GetUserAddress $address)
    {
        $this->authorize('viewAny', UserAddress::class);

        $userId = auth('sanctum')->user()->id;
        $addresses = $address->get($userId);

        return $this->response($addresses);
    }

    public function store(StoreAddressRequest $request, StoreAddress $addresAction)
    {
        $this->authorize('create', UserAddress::class);

        $storedAddress = $addresAction->store($request);

        return $this->response($storedAddress);
    }

    public function show(UserAddress $userAddress, GetDetailUserAddress $addresAction)
    {
        $this->authorize('view', $userAddress);

        $userAddress = $addresAction->get($userAddress);

        return $this->response($userAddress);
    }

    public function destroy(UserAddress $userAddress, DestroyUserAddress $addresAction)
    {
        $this->authorize('delete', $userAddress);

        $deleted = $addresAction->delete($userAddress);

        return $this->response($deleted);
    }
}
