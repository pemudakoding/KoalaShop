<?php

namespace App\Abstracts\Actions;

use App\Contracts\InternalResponse;
use App\Repositories\Address\EloquentUserAddressRepository;

class UserAddressBaseAction
{
    use InternalResponse;

    protected EloquentUserAddressRepository $userAddressRepository;

    public function __construct()
    {
        $this->userAddressRepository = new EloquentUserAddressRepository();
    }
}
