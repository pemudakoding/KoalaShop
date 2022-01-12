<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Models\User;
use App\Services\Authentications\Login;

class LoginController extends Controller
{

    public function conventionalLogin(LoginRequest $request)
    {

        $user = (new Login)->signIn('sanctum', $request);
        $data = [
            'msg' => 'Successfully login!',
            'data' => $user
        ];

        return response()
            ->json($data, 200, ['Content-Type' => 'application/json']);
    }
}
