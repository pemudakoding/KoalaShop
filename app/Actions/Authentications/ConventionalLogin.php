<?php

namespace App\Actions\Authentications;

use App\Contracts\InternalResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ConventionalLogin
{

    use InternalResponse;

    public function execute($request): array
    {

        $user = User::getUserByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
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
