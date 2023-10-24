<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz\Test;
use Prettus\Repository\Eloquent\BaseRepository;

class TestRepository extends BaseRepository
{

    public function model()
    {
        return Test::class;
    }

    public function getAll($params = [], $limit = 20)
    {
        $params = array_merge([
            'status' => [],
            'category_id' => [],
            'subject_id' => [],
            'position' => [],
            'search' => null,
        ], $params);

        $result = Test::select(
            Test::TABLE . '.*'
        );

        if ( !empty($params['search']) ) {
            $result->where(Test::TABLE . '.title', 'LIKE', '%' . $params['search'] . '%');
        }

        if (!empty($params['status']) && is_array($params['status'])) {
            $result->whereIn(Test::TABLE . '.status', $params['status']);
        }

        if ( !empty($params['position']) && is_array($params['position']) ) {
            $result->whereIn(Test::TABLE . '.position', $params['position']);
        }

        if ( !empty($params['category_id']) && is_array($params['category_id']) ) {
            $result->whereIn(Test::TABLE . '.category_id', $params['category_id']);
        }

        if ( !empty($params['subject_id']) && is_array($params['subject_id']) ) {
            $result->whereIn(Test::TABLE . '.subject_id', $params['subject_id']);
        }

        $result->orderBy(Test::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById($id)
    {
        return Test::find($id);
    }
}
