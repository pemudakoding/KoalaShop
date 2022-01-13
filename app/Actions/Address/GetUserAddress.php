<?php

namespace App\Actions\Address;

use App\Abstracts\Response as AbstractResponse;
use App\Contracts\InternalResponse;
use App\Repositories\Address\EloquentUserAddressRepository;

class GetUserAddress
{

    use InternalResponse;

    private object $userAddressRepository;

    public function __construct()
    {
        $this->userAddressRepository = new EloquentUserAddressRepository();
    }


    public function get(int $userId): array
    {

        $addresses = $this->userAddressRepository->getUserAddress($userId);

        return $this->response('Successfully get addresses', $addresses, 200);
    }
}
