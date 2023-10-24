<?php

namespace App\Models\Orders;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    const TABLE = 'orders_detail';
    protected $table = self::TABLE;
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'tax',
        'discount',
        'total',
        'qty',
        'warranty',
        'maintenance',
        'quantity_in_stock',
        'status_in_stock',
        'color',
        'delivery_time',
        'request_description',
        'product_name',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
