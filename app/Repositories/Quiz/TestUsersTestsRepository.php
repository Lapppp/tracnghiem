<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz\Test;
use App\Models\Quiz\TestUsersTests;
use Prettus\Repository\Eloquent\BaseRepository;

class TestUsersTestsRepository extends BaseRepository
{

    public function model()
    {
        return TestUsersTests::class;
    }

    public function getAll($params = [], $limit = 20)
    {
        $params = array_merge([
            'status' => [],
            'position' => [],
            'test_id' => null,
        ], $params);

        $result = TestUsersTests::select(
            TestUsersTests::TABLE.'.*'
        );

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(TestUsersTests::TABLE.'.status', $params['status']);
        }

        if ( !empty($params['test_id']) ) {
            $result->where(TestUsersTests::TABLE.'.test_id', '=', $params['test_id']);
        }

        if ( !empty($params['position']) && is_array($params['position']) ) {
            $result->whereIn(TestUsersTests::TABLE.'.position', $params['position']);
        }

        $result->orderBy(TestUsersTests::TABLE.'.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById($id)
    {
        return TestUsersTests::find($id);
    }

    public function checkUserTest($params = [])
    {
        return TestUsersTests::where('test_id', $params['test_id'])
            ->where('user_id', $params['user_id'])
            ->first();
    }
}
