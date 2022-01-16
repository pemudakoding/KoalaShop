<?php

namespace App\Abstracts\Actions;

use App\Contracts\InternalResponse;
use App\Repositories\Order\EloquentOrderRepository;

abstract class OrderBaseAction
{

    use InternalResponse;
}
