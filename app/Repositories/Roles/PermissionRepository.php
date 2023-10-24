<?php

namespace App\Repositories\Roles;

use App\Models\Roles\Permission;
use Prettus\Repository\Eloquent\BaseRepository;

class PermissionRepository extends BaseRepository
{

    public function model()
    {
        return Permission::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'parent_id' => [],
            'guard_name' => 'backend',
        ], $params);

        $result = Permission::select(
            Permission::TABLE . '.*',
        );

        if ( !empty($params['parent_id']) && is_array($params['parent_id']) ) {
            $params['parent_id'] = implode(',', $params['parent_id']);
            $result->whereRaw("FIND_IN_SET(" . Permission::TABLE . ".parent_id,'" . $params['parent_id'] . "')");
        }
        if(!empty($params['guard_name'])) {
            $result->where(Permission::TABLE.'.guard_name',$params['guard_name']);
        }

        $result->orderBy(Permission::TABLE . '.id', 'desc');

        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getByID($id){
        return Permission::find($id);
    }
}
