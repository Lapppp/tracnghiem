<?php

namespace App\Repositories\Banners;

use App\Enums\Banners\BannerStatusType;
use App\Models\Banners\Banner;
use Prettus\Repository\Eloquent\BaseRepository;

class BannerRepository extends BaseRepository
{

    public function model()
    {
        return Banner::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
            'position' => [],
            'type' => [],
        ], $params);

        $result = Banner::select(
            Banner::TABLE . '.*'
        );

        if ( !empty($params['search']) ) {
            $result->where(Banner::TABLE.'.name', 'LIKE', '%' . $params['search'] . '%');
        }

        if ( !empty($params['position']) && is_array($params['position']) ) {
            $result->whereIn(Banner::TABLE . '.position', $params['position']);
        }

        if ( !empty($params['type']) && is_array($params['type']) ) {
            $result->whereIn(Banner::TABLE . '.type', $params['type']);
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(Banner::TABLE . '.status', $params['status']);
        }

        $result->orderBy(Banner::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Banner::find($id);
    }

    public function lastItems() {
        return Banner::where('status',BannerStatusType::Approved)->latest('id')->first();
    }
}
