<?php

namespace App\Abstracts\Actions;

use App\Contracts\InternalResponse;
use App\Repositories\Product\EloquentProductRepository;

abstract class ProductBaseAction
{
    use InternalResponse;
}
