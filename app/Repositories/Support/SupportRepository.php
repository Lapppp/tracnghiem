<?php

namespace App\Repositories\Support;

use App\Models\Support\Support;
use Prettus\Repository\Eloquent\BaseRepository;

class SupportRepository extends BaseRepository
{

    public function model()
    {
        return Support::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Support::select(
            Support::TABLE . '.*'
        );

        $result->orderBy(Support::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Support::find($id);
    }
}
