<?php

namespace App\Repositories\Provinces;

use App\Models\Provinces\Province;
use Prettus\Repository\Eloquent\BaseRepository;

class ProvinceRepository extends BaseRepository
{

    public function model()
    {
        return Province::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Province::select(
            Province::TABLE . '.*'
        );

        $result->orderBy(Province::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Province::find($id);
    }
}
