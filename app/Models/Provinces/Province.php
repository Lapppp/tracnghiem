<?php

namespace App\Models\Provinces;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    const TABLE = 'provinces';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'type',
        'slug',
    ];
}
