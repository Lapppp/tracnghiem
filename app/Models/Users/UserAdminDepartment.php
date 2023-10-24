<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdminDepartment extends Model
{
    use HasFactory;

    const TABLE = 'users_admin_department';
    protected $table = self::TABLE;
    protected $fillable = [
        'user_id',
        'admin_id',
        'department_id',
        'type',
    ];
}
