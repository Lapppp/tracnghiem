<?php

namespace App\Models\Departments;

use App\Models\Admin\Admin;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDepartment extends Model
{
    use HasFactory;

    const TABLE = 'admin_department';
    protected $table = self::TABLE;
    protected $fillable = [
        'id',
        'admin_id',
        'department_id',
        'is_manager',
    ];
}
