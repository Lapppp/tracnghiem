<?php

namespace App\Repositories\Units;

use App\Models\Units\Unit;
use Prettus\Repository\Eloquent\BaseRepository;

class UnitRepository extends BaseRepository
{

    public function model()
    {
        return Unit::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Unit::select(
            Unit::TABLE . '.*'
        );

        $result->orderBy(Unit::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Unit::find($id);
    }
}
