<?php

namespace App\Actions\Product;

use App\Abstracts\Actions\ProductBaseAction;
use App\Models\Product;
use Illuminate\Support\Str;

class StoreProduct extends ProductBaseAction
{

    public function store(array $data): array
    {


        $storing = $this->execute($data);

        return $this->response('Successfully creating product!', $storing, 201);
    }

    private function execute(array $data): object
    {

        $slug = Str::slug($data['name'] . " " . date('jwyzhi'));
        $data['slug'] = $slug;
        $data['user_id'] = auth('sanctum')->user()->id;

        return Product::create($data);
    }
}
