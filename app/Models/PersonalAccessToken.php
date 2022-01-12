<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;


class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory;


    public static function updateByUserId($userId, $data)
    {

        $tokenData = self::where('user_id', $userId)->first();

        if ($tokenData) return $tokenData->update($data);
    }
}
