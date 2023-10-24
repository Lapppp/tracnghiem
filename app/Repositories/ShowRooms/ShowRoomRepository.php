<?php

namespace App\Repositories\ShowRooms;

use App\Models\ShowRooms\ShowRoom;
use Prettus\Repository\Eloquent\BaseRepository;

class ShowRoomRepository extends BaseRepository
{

    public function model()
    {
        return ShowRoom::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
            'district_id' => null,
            'province_id' => null,
            'province_ids' => [],
        ], $params);

        $result = ShowRoom::select(
            ShowRoom::TABLE . '.*'
        );

        if(!empty($params['province_id'])) {
            $result->where('province_id',$params['province_id']);
        }


        if ( !empty($params['province_ids']) && is_array($params['province_ids']) ) {
            $result->whereIn(ShowRoom::TABLE . '.province_id', $params['province_ids']);
        }

        $result->orderBy(ShowRoom::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return ShowRoom::find($id);
    }
    public function getTotal()
    {
        return ShowRoom::count();
    }
}
