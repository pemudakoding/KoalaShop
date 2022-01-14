<?php

namespace App\Abstracts\Actions;

use App\Contracts\InternalResponse;
use App\Repositories\User\EloquentUserRepository;

abstract class AuthenticationBaseAction
{

    use InternalResponse;

    protected EloquentUserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new EloquentUserRepository();
    }
}
