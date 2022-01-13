<?php

namespace App\Repositories\User;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;


class EloquentUserRepository implements UserRepositoryInterface
{

    public function getUserByEmail(string $email): object
    {
        return User::where('email', $email)->first();
    }

    public function firstOrCreate(array $trigger, array $dataWillUpdate): object
    {
        return User::firstOrCreate($trigger, $dataWillUpdate);
    }
}
