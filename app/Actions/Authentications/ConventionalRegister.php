<?php

namespace App\Actions\Authentications;

use App\Abstracts\Actions\AuthenticationBaseAction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ConventionalRegister extends AuthenticationBaseAction
{

    public function execute($request): array
    {

        $userPassword = Hash::make($request['password']);

        $user = User::firstOrCreate(
            ['email' => $request['email']],
            [
                'name' => $request['name'],
                'password' => $userPassword
            ]
        );

        $token = $user->createToken('auth_token')
            ->plainTextToken;

        return $this->response(
            'User successfully registered!',
            [
                'user' => $user->name,
                'access_token' => $token,
                'token_type' => 'bearer'
            ],
            200
        );
    }
}
