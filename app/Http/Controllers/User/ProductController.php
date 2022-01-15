<?php

namespace App\Http\Controllers\Product;

use App\Actions\Product\{DestroyProduct, GetDetailProduct, GetProduct, UpdateProduct};
use App\Contracts\ClientResponse;
use App\Services\Product\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\SearchProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    use ClientResponse;

    public function index(SearchProductRequest $request, GetProduct $productAction)
    {
        $this->authorize('viewAny', Product::class);

        $userId = $request->user()->id;
        $products = $productAction->get($userId, $request);

        return $this->response($products);
    }

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

    public function update(UpdateProductRequest $request, Product $product, UpdateProduct $productAction)
    {
        $this->authorize('update', $product);

        $product = $productAction->update($product, $request);

        return $this->response($product);
    }

    public function destroy(Product $product, DestroyProduct $productAction)
    {
        $this->authorize('delete', $product);

        $product = $productAction->delete($product);

        return $this->response($product);
    }
}
