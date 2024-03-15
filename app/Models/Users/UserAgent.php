<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAgent extends Model
{
    use HasFactory;

    const TABLE = 'user_agent';
    protected $table = self::TABLE;
    protected $fillable = [
        'user_id',
        'keyVersion',
        'deviceVersion',
        'deviceType',
        'description',
        'created_at',
        'updated_at',
        'ip_login',
    ];
}
