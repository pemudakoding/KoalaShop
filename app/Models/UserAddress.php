<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title', 'address',
        'user_id'
    ];

    public static function getUserAddress($userId)
    {
        return self::where('user_id', $userId)->get();
    }
}
