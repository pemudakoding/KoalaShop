<?php

namespace App\Services\Authentications;

use App\Actions\Authentications\{ConventionalRegister, GetUserByProvider, UpdateToken};


class Register
{

    public function store(string $driver, $request = null)
    {

        if ($driver === 'sanctum') {

            return (new ConventionalRegister)->execute($request);
        }
    }
}
