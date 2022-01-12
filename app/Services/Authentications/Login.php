<?php

namespace App\Services\Authentications;

use App\Actions\Authentications\{ConventionalLogin};


class Login
{

    public function signIn(string $driver, $request = null): array
    {

        if ($driver === 'sanctum') {

            return (new ConventionalLogin)->execute($request);
        }
    }
}
