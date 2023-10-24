<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz\Answer;
use App\Models\Quiz\Test;
use Prettus\Repository\Eloquent\BaseRepository;

class AnswerRepository extends BaseRepository
{

    public function model()
    {
        return Answer::class;
    }

    public function getAll($params = [], $limit = 20)
    {
        $params = array_merge([
            'status' => [],
        ], $params);

        $result = Test::select(
            Test::TABLE.'.*'
        );

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(Test::TABLE.'.status', $params['status']);
        }

        $result->orderBy(Answer::TABLE.'.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById($id)
    {
        return Answer::find($id);
    }

    public function getByQuestion($question_id, $answer_id)
    {
        return Answer::where('post_id', $question_id)
            ->where('id', $answer_id)
            ->first();
    }
}
