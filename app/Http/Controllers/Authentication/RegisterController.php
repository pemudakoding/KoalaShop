<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Services\Authentications\Register;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class RegisterController extends Controller
{


    public function conventionalRegister(RegisterRequest $request, Register $register)
    {

        $user = $register->store('sanctum', $request);

        $json = [
            'msg' => 'User successfully registered!',
            'data' => $user
        ];

        return response()
            ->json($json, 201, [
                'Content-Type' => 'application/json'
            ]);
    }
}
