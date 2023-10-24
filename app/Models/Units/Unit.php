<?php

namespace App\Models\Units;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    const TABLE = 'units';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'status',
    ];

    public function product() {
        return $this->hasOne(Product::class,'unit_id','id');
    }
}
