<?php

namespace App\Repositories\Quiz;


use App\Models\Post\QuestionsPart;
use App\Models\Quiz\TestUser;
use Prettus\Repository\Eloquent\BaseRepository;

class QuestionsPartRepository extends BaseRepository
{

    public function model()
    {
        return QuestionsPart::class;
    }
    public function getById($id)
    {
        return QuestionsPart::find($id);
    }
}
