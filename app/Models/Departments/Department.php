<?php

namespace App\Models\Departments;

use App\Models\Admin\Admin;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    const TABLE = 'departments';
    protected $table = self::TABLE;
    protected $fillable = [
        'id',
        'name',
        'code',
        'status',
    ];

    public function admins(){
        //return $this->belongsToMany(User::class); // cần tạo bảng department_user
         return $this->belongsToMany(Admin::class, 'admin_department', 'department_id', 'admin_id');
    }

    public function manager(){
        return $this->belongsToMany(Admin::class, 'admin_department', 'department_id', 'admin_id')->where('is_manager',1);
    }
}
