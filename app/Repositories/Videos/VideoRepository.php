<?php

namespace App\Repositories\Videos;

use App\Models\Videos\Video;
use Prettus\Repository\Eloquent\BaseRepository;

class VideoRepository extends BaseRepository
{

    public function model()
    {
        return Video::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Video::select(
            Video::TABLE . '.*'
        );

        $result->orderBy(Video::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Video::find($id);
    }
}
