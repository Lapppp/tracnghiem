<?php

namespace App\Repositories\Districts;

use App\Models\Districts\District;
use Prettus\Repository\Eloquent\BaseRepository;

class DistrictRepository extends BaseRepository
{

    public function model()
    {
        return District::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'city_id' => [],
        ], $params);

        $result = District::select(
            District::TABLE . '.*'
        );

        if(!empty( $params['city_id']) && is_array($params['city_id'])) {
            $result->whereIn('city_id',$params['city_id']);
        }

        $result->orderBy(District::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return District::find($id);
    }
}
