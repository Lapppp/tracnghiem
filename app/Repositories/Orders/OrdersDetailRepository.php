<?php

namespace App\Repositories\Orders;

use App\Models\Orders\OrderDetail;
use Prettus\Repository\Eloquent\BaseRepository;

class OrdersDetailRepository extends BaseRepository
{

    public function model()
    {
        return OrderDetail::class;
    }
}
