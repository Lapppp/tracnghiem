<?php

namespace App\Models\Advises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advise extends Model
{
    use HasFactory;

    const TABLE = 'advises';
    protected $table = self::TABLE;
    protected $fillable = [
        'full_name',
        'phone',
        'description',
        'email',
    ];

}
