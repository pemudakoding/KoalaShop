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

    public static function getUserAddressBySlug($slug)
    {
        return self::with('user')->where('slug', $slug)->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
