<?php

namespace App\Repositories\Companies;

use App\Models\Companies\Company;
use Prettus\Repository\Eloquent\BaseRepository;

class CompanyRepository extends BaseRepository
{

    public function model()
    {
        return Company::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Company::select(
            Company::TABLE . '.*'
        );

        $result->orderBy(Company::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Company::find($id);
    }
}
