<?php

namespace App\Actions\ProductPhoto;

use App\Models\ProductPhoto;

class StoreProductPhoto
{

    public function store($tempPath, $productId, $driver = 'minio')
    {
        $photos = (new StorePhoto)->handle($tempPath, $productId, $driver);

        return ProductPhoto::insert($photos);
    }
}
