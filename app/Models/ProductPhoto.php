<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductPhoto extends Model
{
    use HasFactory;

    public function getNameAttribute($value)
    {
        if (Storage::disk('minio')->exists($value)) {
            return Storage::disk('minio')->url($value);
        } else {
            return $value;
        }
    }
}
