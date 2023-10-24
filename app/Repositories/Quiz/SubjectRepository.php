<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz\Subject;
use Prettus\Repository\Eloquent\BaseRepository;

class SubjectRepository extends BaseRepository
{

    public function model()
    {
        return Subject::class;
    }

    public function getAll($params = [], $limit = 20)
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Subject::select(
            Subject::TABLE . '.*'
        );

        $result->orderBy(Subject::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById($id)
    {
        return Subject::find($id);
    }
}
