<?php

namespace App\Services\Product;

use App\Actions\Product\StoreProduct;
use App\Actions\ProductPhoto\StoreProductPhoto;
use App\Events\ProductStored;
use App\Models\ProductPhoto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreProductService
{

    public function store($request): array
    {

        $productAction = (new StoreProduct)->store($request->toArray());
        $storePhotoProduct = (new StoreProductPhoto)->store(
            $request->photos,
            $productAction['data']['id']
        );
        return $productAction;
    }
}
