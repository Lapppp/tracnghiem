<?php

namespace App\Repositories\Brand;

use App\Models\Brands\Brand;
use Prettus\Repository\Eloquent\BaseRepository;

class BrandRepository extends BaseRepository
{

    public function model()
    {
        return Brand::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Brand::select(
            Brand::TABLE . '.*'
        );

        $result->orderBy(Brand::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Brand::find($id);
    }
}
