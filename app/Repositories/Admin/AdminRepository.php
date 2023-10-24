<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Admin;
use Prettus\Repository\Eloquent\BaseRepository;

class AdminRepository extends BaseRepository
{

    public function model()
    {
        return Admin::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
            'id' => [],
        ], $params);

        $result = Admin::select(
            Admin::TABLE . '.*'
        );

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $params['status'] = implode(',', $params['status']);
            $result->whereRaw("FIND_IN_SET(" . Admin::TABLE . ".status,'" . $params['status'] . "')");
        }

        if ( !empty($params['id']) && is_array($params['id']) ) {
            $result->whereIn('id', $params['id']);
        }

        $result->orderBy(Admin::TABLE . '.id', 'desc');
        $per_page = !empty($limit) ? $limit : config('pagination.per_page');

        return empty($limit) ? $result->get() : $result->paginate($per_page);
    }

    public function getByID( $id )
    {
        return Admin::find($id);
    }
}
