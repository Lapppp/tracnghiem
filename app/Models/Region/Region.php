<?php

namespace App\Models\Region;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    const TABLE = 'region';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'code',
    ];
}
