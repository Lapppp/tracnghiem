<?php

namespace App\Repositories\Orders;

use App\Models\Brands\Brand;
use App\Models\Orders\Order;
use App\Models\Orders\OrderDetail;
use App\Models\Products\Product;
use Prettus\Repository\Eloquent\BaseRepository;

class OrderRepository extends BaseRepository
{

    public function model()
    {
        return Order::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'ids' => [],
            'status' => [],
            'search' => null,
            'start_date' => null,
            'end_date' => null,
            'user_id' => null,
        ], $params);

        $result = Order::select(
            Order::TABLE . '.*'
        );


        if ( !empty($params['search']) ) {
            $result->where(Order::TABLE.'.full_name', 'LIKE', '%'.$params['search'].'%');
            $result->orWhere(Order::TABLE.'.phone', 'LIKE', '%'.$params['search'].'%');
            $result->orWhere(Order::TABLE.'.email', 'LIKE', '%'.$params['search'].'%');
        }

        if ( !empty($params['start_date']) && empty($params['end_date']) ) {
            $startDate = date('Y-m-d', strtotime($params['start_date']));
            $result->whereDate(Order::TABLE . '.created_at', '>=', $startDate);
        }

        if ( empty($params['start_date']) && !empty($params['end_date']) ) {
            $endDate = date('Y-m-d', strtotime($params['end_date']));
            $result->whereDate(Order::TABLE . '.created_at', '=', $endDate);
        }

        if ( !empty($params['start_date']) && !empty($params['end_date']) ) {
            $startDate = date('Y-m-d', strtotime($params['start_date']));
            $endDate = date('Y-m-d', strtotime($params['end_date']));
            $result->whereDate(Order::TABLE . '.created_at', '>=', $startDate)
                ->whereDate(Order::TABLE . '.created_at', '<=', $endDate);
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(Order::TABLE.'.status', $params['status']);
        }

        if ( !empty($params['user_id']) && is_array($params['user_id']) ) {
            $result->whereIn(Order::TABLE.'.user_id', $params['user_id']);
        }

        if ( !empty($params['ids']) && is_array($params['ids']) ) {
            $result->whereIn(Order::TABLE.'.id', $params['ids']);
        }

        $result->orderBy(Order::TABLE . '.id', 'desc');

        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Order::find($id);
    }
}
