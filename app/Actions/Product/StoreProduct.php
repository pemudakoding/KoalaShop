<?php

namespace App\Actions\Product;

use App\Contracts\InternalResponse;
use App\Repositories\Product\EloquentProductRepository;
use Illuminate\Support\Str;

class StoreProduct
{

    use InternalResponse;

    private EloquentProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new EloquentProductRepository();
    }

    public function store(object $request): array
    {

        $storing = $this->execute($request);

        return $this->response('Successfully creating product!', $storing, 201);
    }

    private function execute(object $request): object
    {

        $slug = Str::slug($request->name . " " . date('jwyzhi'));
        $productData = $request->only(['name', 'description', 'stocks', 'price']);
        $productData['slug'] = $slug;
        $productData['user_id'] = $request->user()->id;

        return $this->productRepository->create($productData);
    }
}
