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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getAddressBySlug(string $slug)
    {
        return self::where('slug', $slug)
            ->first();
    }

    public static function getAddressInstaceBySlug(string $slug)
    {
        return self::select('id')
            ->where('slug', $slug)
            ->first();
    }
}
