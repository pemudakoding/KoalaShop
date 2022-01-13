<?php

namespace App\Http\Controllers\Authentication;

use App\Contracts\ClientResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Models\User;
use App\Services\Authentications\Login;

class LoginController extends Controller
{

    use ClientResponse;

    public function conventionalLogin(LoginRequest $request)
    {

        $user = (new Login)->signIn('sanctum', $request);

        return $this->response($user);
    }
}
