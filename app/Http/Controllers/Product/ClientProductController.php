<?php

namespace App\Http\Controllers\Product;

use App\Actions\Product\{GetDetailProduct, GetProduct};
use App\Contracts\ClientResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\SearchProductRequest;
use App\Models\Product;

class ClientProductController extends Controller
{

    use ClientResponse;

    public function index(SearchProductRequest $request, GetProduct $productAction)
    {
        $products = $productAction->get(null, $request->toArray());

        return $this->response($products);
    }

    public function show(Product $product, GetDetailProduct $productAction)
    {
        $product = $productAction->get($product);

        return $this->response($product);
    }
}
