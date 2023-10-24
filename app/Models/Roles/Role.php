<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const TABLE = 'roles';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'team_id',
        'guard_name',
        'customize_name',
    ];
}
