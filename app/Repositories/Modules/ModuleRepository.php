<?php

namespace App\Repositories\Modules;

use App\Models\Modules\Module;
use Prettus\Repository\Eloquent\BaseRepository;

class ModuleRepository extends BaseRepository
{

    public function model()
    {
        return Module::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
            'search' => null,
        ], $params);

        $result = Module::select(
            Module::TABLE . '.*'
        );

        if ( !empty($params['search']) ) {
            $result->where('search', 'LIKE', '%' . $params['search'] . '%');
        }

        $result->orderBy(Module::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Module::find($id);
    }
}
