<?php

namespace App\Repositories\Questions;

use App\Models\Questions\Question;
use Prettus\Repository\Eloquent\BaseRepository;

class QuestionRepository extends BaseRepository
{

    public function model()
    {
        return Question::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Question::select(
            Question::TABLE . '.*'
        );

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(Question::TABLE . '.status', $params['status']);
        }

        $result->orderBy(Question::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Question::find($id);
    }
}
