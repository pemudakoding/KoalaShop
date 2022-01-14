<?php

namespace App\Http\Controllers\Product;

use App\Actions\Product\GetDetailProduct;
use App\Contracts\ClientResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;
use App\Services\Product\ProductService;

class ProductController extends Controller
{

    use ClientResponse;

    public function store(StoreProductRequest $request, ProductService $productService)
    {
        $this->authorize('create', Product::class);

        $product = $productService->store($request);

        return $this->response($product);
    }

    public function show(Product $product, GetDetailProduct $productAction)
    {


        $this->authorize('view', $product);

        $product = $productAction->get($product);

        return $this->response($product);
    }
}
