<?php

namespace App\Models\Hamlets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hamlet extends Model
{
    use HasFactory;

    const TABLE = 'hamlets';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'type',
        'district_id',
    ];
}
