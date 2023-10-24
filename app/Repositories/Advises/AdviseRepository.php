<?php

namespace App\Repositories\Advises;

use App\Models\Advises\Advise;
use Prettus\Repository\Eloquent\BaseRepository;

class AdviseRepository extends BaseRepository
{

    public function model()
    {
        return Advise::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Advise::select(
            Advise::TABLE . '.*'
        );

        $result->orderBy(Advise::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Advise::find($id);
    }
}
