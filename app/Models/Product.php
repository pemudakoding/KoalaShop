<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'name', 'description',
        'stocks', 'price', 'user_id'
    ];

    public function productOwner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id', 'id');
    }

    public static function getInstanceBySlug(string $slug)
    {
        return self::select('id')
            ->where('slug', $slug)
            ->first();
    }

    public static function getProductPrice(int $productId)
    {
        return self::select('price')
            ->where('id', $productId)
            ->first();
    }
}
