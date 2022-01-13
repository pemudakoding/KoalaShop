<?php

namespace App\Actions\Address;

use App\Contracts\InternalResponse;
use App\Models\UserAddress;
use Illuminate\Support\Str;

class StoreAddress
{

    use InternalResponse;

    public function store($request): bool|array
    {
        $userId = $request->user()->id;

        $requestBody = $request->only(['title', 'address']);
        $requestBody['slug'] = Str::slug($requestBody['title']);
        $requestBody['user_id'] = $userId;

        return $this->execute($requestBody);
    }

    private function execute(array $data): array
    {
        $address = UserAddress::where('slug', $data['slug'])->first();
        if ($address) {
            return $this->response('Failed create duplicate address', null, 400);
        }

        $address = UserAddress::create($data);

        return $this->response(
            'Successfully creating address',
            [
                'name' => auth('sanctum')->user()->name,
                'address_title' => $address->title,
            ],
            200
        );
    }
}
