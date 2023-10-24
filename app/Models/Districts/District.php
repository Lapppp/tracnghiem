<?php

namespace App\Models\Districts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    const TABLE = 'districts';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'type',
        'city_id',
    ];
}
