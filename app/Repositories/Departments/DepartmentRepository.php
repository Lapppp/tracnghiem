<?php

namespace App\Repositories\Departments;

use App\Models\Departments\Department;
use App\Models\Departments\AdminDepartment;
use Prettus\Repository\Eloquent\BaseRepository;

class DepartmentRepository extends BaseRepository
{

    public function model()
    {
        return Department::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Department::select(
            Department::TABLE . '.*'
        );

        if ( !empty($params['search']) ) {
            $result->where(Department::TABLE . '.name', 'LIKE', '%' . $params['search'] . '%');
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(Department::TABLE . '.status', $params['status']);
        }

        $result->orderBy(Department::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Department::find($id);
    }

    /**
     * Reset manager
     * @param $department_id
     * @param $user_id
     * @param int $is_manager
     * @return mixed
     */
    public function updateManager( $department_id, $user_id, $is_manager = 1 )
    {
        return AdminDepartment::where('department_id', (int) $department_id)
            ->where('admin_id', (int) $user_id)
            ->update(['is_manager' => $is_manager]);
    }

    public function updateResetManagerDepartment( $department_id, $is_manager = 0 )
    {
        return AdminDepartment::where('department_id', (int) $department_id)
            ->update(['is_manager' => $is_manager]);
    }
}
