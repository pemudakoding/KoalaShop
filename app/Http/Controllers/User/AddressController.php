<?php

namespace App\Http\Controllers\User;

use App\Actions\Address\{StoreAddress, GetUserAddress};
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreAddressRequest;
use App\Models\UserAddress;


class AddressController extends Controller
{


    public function index(GetUserAddress $address)
    {
        $this->authorize('viewAny', UserAddress::class);

        $addresses = $address->get(auth('sanctum')->user()->id);

        return response()
            ->json($addresses, $addresses['code'], [
                'Content-Type' => 'application/json'
            ]);
    }

    public function store(StoreAddressRequest $request, StoreAddress $addresAction)
    {
        $this->authorize('create', UserAddress::class);

        $storedAddress = $addresAction->execute($request);

        return response()
            ->json($storedAddress, $storedAddress['code'], [
                'Content-Type' => 'application/json'
            ]);
    }
}
