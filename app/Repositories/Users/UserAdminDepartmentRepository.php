<?php

namespace App\Repositories\Users;

use App\Models\Users\UserAdminDepartment;
use Prettus\Repository\Eloquent\BaseRepository;

class UserAdminDepartmentRepository extends BaseRepository
{

    public function model()
    {
        return UserAdminDepartment::class;
    }

    public function checkUserAdminDepartment( $params = [] )
    {
        return UserAdminDepartment::where('user_id', $params['user_id'])
            ->where('admin_id', $params['admin_id'])
            ->where('department_id', $params['department_id'])
            ->where('type', $params['type'])
            ->first();
    }

    public function checkUserAdminManagerDepartment( $params = [] )
    {
         return UserAdminDepartment::where('department_id', $params['department_id'])
            ->where('type', $params['type'])
            ->first();
    }

    public function deleteUserAdminDepartment( $params = [] )
    {
        return UserAdminDepartment::where('department_id', $params['department_id'])
            ->where('type', '!=', $params['type'])
            ->delete();
    }

    public function checkUserAdminDepartmentType( $params = [] )
    {
        return UserAdminDepartment::where('user_id', $params['user_id'])
            ->where('department_id', $params['department_id'])
            ->where('type', $params['type'])
            ->first();
    }

    public function checkUserDepartment( $params = [] )
    {
        return UserAdminDepartment::where('user_id', $params['user_id'])
            ->where('department_id', $params['department_id'])
            ->get();
    }

}
