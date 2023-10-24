<?php

namespace App\Models\Teams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    const TABLE = 'teams';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
    ];
}
