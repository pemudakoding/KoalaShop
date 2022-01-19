<?php

namespace App\Actions\ProductPhoto;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StorePhoto
{

    public function handle($path, $productId, $driver)
    {
        $photos = [];
        if (gettype($path) === 'array') {

            foreach ($path as $photo) {
                $photos[] = [
                    'name' => Storage::disk($driver)->put('products', $photo),
                    'product_id' => $productId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            };
        } else {

            $photos[] = [
                'name' => Storage::disk($driver)->put('products', $path),
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        return $photos;
    }
}
