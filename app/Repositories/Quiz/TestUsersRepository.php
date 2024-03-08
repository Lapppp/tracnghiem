<?php

namespace App\Repositories\Quiz;


use App\Models\Quiz\TestUser;
use Prettus\Repository\Eloquent\BaseRepository;

class TestUsersRepository extends BaseRepository
{

    public function model()
    {
        return TestUser::class;
    }

    public function getUserTest($params = [])
    {
        return  TestUser::where('user_id', '=', $params['user_id'])
            ->where('test_id', '=', $params['test_id'])
            ->where('question_id', '=', $params['question_id'])
            ->first();
    }

    public function checkUserTest($params = [])
    {
        return  TestUser::where('user_id', '=', $params['user_id'])
            ->where('test_id', '=', $params['test_id']);
    }
}
