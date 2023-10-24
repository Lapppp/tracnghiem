<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    const TABLE = 'companies';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'certificate',
        'granted_by',
        'address',
        'meta_header',
        'meta_body',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'textCate',
    ];

}
