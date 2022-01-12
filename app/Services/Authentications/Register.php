<?php

namespace App\Services\Authentications;

use App\Actions\Authentications\{ConventionalRegister};


class Register
{

    public function store(string $driver, $request = null)
    {

        if ($driver === 'sanctum') {

            return (new ConventionalRegister)->execute($request);
        }
    }
}
