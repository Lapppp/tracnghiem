<?php

namespace App\Models\Brands;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    const TABLE = 'brands';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'brand_slug',
        'status',
    ];
}
