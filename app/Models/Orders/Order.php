<?php

namespace App\Models\Orders;

use App\Models\Districts\District;
use App\Models\Hamlets\Hamlet;
use App\Models\Provinces\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const TABLE = 'orders';
    protected $table = self::TABLE;
    protected $fillable = [
        'total',
        'coupon_code',
        'coupon_amount',
        'order_price',
        'user_id',
        'user_id',
        'full_name',
        'address',
        'phone',
        'email',
        'order_notes',
        'province_id',
        'district_id',
        'hamlet_id',
        'code',
        'status',
        'paymentMethod',
        'source'
    ];

    public function ordersDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id')->withDefault([
            'name'=>'province -  dont know'
        ]);
    }

    public function district() {
        return $this->belongsTo(District::class, 'district_id', 'id')->withDefault([
            'name'=>'district -  dont know'
        ]);
    }

    public function hamlet() {
        return $this->belongsTo(Hamlet::class,'hamlet_id','id')->withDefault([
            'name'=>'hamlet -  dont know'
        ]);
    }
}
