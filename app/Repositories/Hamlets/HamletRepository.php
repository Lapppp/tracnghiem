<?php

namespace App\Repositories\Hamlets;

use App\Models\Districts\District;
use App\Models\Hamlets\Hamlet;
use Prettus\Repository\Eloquent\BaseRepository;

class HamletRepository extends BaseRepository
{

    public function model()
    {
        return Hamlet::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'district_id' => [],
        ], $params);

        $result = Hamlet::select(
            Hamlet::TABLE . '.*'
        );

        if(!empty( $params['district_id']) && is_array($params['district_id'])) {
            $result->whereIn('district_id',$params['district_id']);
        }

        $result->orderBy(Hamlet::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Hamlet::find($id);
    }
}
