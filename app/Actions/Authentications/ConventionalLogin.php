<?php

namespace App\Actions\Authentications;

use App\Abstracts\Actions\AuthenticationBaseAction;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class ConventionalLogin extends AuthenticationBaseAction
{

    public function execute($request): array
    {

        $user = User::where('email', $request['email'])
            ->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.' . $user->password],
            ]);
        }

        $token = $user->createToken('auth_token')
            ->plainTextToken;


        return $this->response(
            'Successfully signin',
            [
                'user' => $user->name,
                'access_token' => $token,
                'token_type' => 'bearer'
            ],
            200
        );
    }
}
