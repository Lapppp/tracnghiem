<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    const TABLE = 'support';
    protected $table = self::TABLE;
    protected $fillable = [
        'hotline',
        'advise',
        'insurance',
        'email',
        'product_consultation',
        'technical_assistance',
        'free_call_center',
        'zalo',
    ];

}
