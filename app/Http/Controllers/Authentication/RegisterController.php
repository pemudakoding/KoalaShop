<?php

namespace App\Http\Controllers\Authentication;

use App\Contracts\ClientResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Services\Authentications\Register;


class RegisterController extends Controller
{


    use ClientResponse;
    public function conventionalRegister(RegisterRequest $request, Register $register)
    {

        $user = $register->store('sanctum', $request);

        return $this->response($user);
    }
}
