<?php

namespace App\Repositories\Banners;

use App\Enums\Banners\BannerStatusType;
use App\Models\Banners\BGBanner;
use Prettus\Repository\Eloquent\BaseRepository;

class BGBannerRepository extends BaseRepository
{

    public function model()
    {
        return BGBanner::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
            'position' => [],
            'type' => [],
        ], $params);

        $result = BGBanner::select(
            BGBanner::TABLE . '.*'
        );

        if ( !empty($params['search']) ) {
            $result->where(BGBanner::TABLE.'.name', 'LIKE', '%' . $params['search'] . '%');
        }

        if ( !empty($params['position']) && is_array($params['position']) ) {
            $result->whereIn(BGBanner::TABLE . '.position', $params['position']);
        }

        if ( !empty($params['type']) && is_array($params['type']) ) {
            $result->whereIn(BGBanner::TABLE . '.type', $params['type']);
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(BGBanner::TABLE . '.status', $params['status']);
        }

        $result->orderBy(BGBanner::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return BGBanner::find($id);
    }

    public function lastItems() {
        return BGBanner::where('status',BannerStatusType::Approved)->latest('id')->first();
    }
}
