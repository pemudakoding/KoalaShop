<?php

namespace App\Http\Controllers\User;

use App\Actions\Address\{StoreAddress, GetUserAddress};
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

        $addresses = $address->get(auth('sanctum')->user()->id);

        $this->response($addresses);
    }

    public function store(StoreAddressRequest $request, StoreAddress $addresAction)
    {
        $this->authorize('create', UserAddress::class);

        $storedAddress = $addresAction->execute($request);

        $this->response($storedAddress);
    }
}
