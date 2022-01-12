<?php

namespace App\Actions\Authentications;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ConventionalRegister
{

    public function execute($request): array
    {

        $userPassword = Hash::make($request->password);
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'password' => $userPassword
            ]
        );

        $token = $user->createToken('auth_token')
            ->plainTextToken;

        return [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer'
        ];
    }
}
