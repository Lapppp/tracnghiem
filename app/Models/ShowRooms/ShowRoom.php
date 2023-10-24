<?php

namespace App\Models\ShowRooms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowRoom extends Model
{
    use HasFactory;

    const TABLE = 'showrooms';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'url',
        'district_id',
        'province_id',
    ];
}
