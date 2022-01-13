<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getUserByEmail(string $email): object;
    public function firstOrCreate(array $trigger, array $dataWillUpdate): object;
}
