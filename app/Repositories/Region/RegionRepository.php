<?php

namespace App\Repositories\Region;

use App\Models\Departments\Department;
use App\Models\Region\Region;
use Prettus\Repository\Eloquent\BaseRepository;

class RegionRepository extends BaseRepository
{

    public function model()
    {
        return Region::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Region::select(
            Region::TABLE . '.*'
        );

        $result->orderBy(Region::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Region::find($id);
    }
}
