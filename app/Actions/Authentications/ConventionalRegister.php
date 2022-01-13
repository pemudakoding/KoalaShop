<?php

namespace App\Actions\Authentications;

use App\Contracts\InternalResponse;
use App\Models\User;
use App\Repositories\User\EloquentUserRepository;
use Illuminate\Support\Facades\Hash;

class ConventionalRegister
{

    use InternalResponse;

    public function __construct()
    {
        $this->userRepository = new EloquentUserRepository();
    }

    public function execute($request): array
    {

        $userPassword = Hash::make($request->password);

        $user = $this->userRepository->firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
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
