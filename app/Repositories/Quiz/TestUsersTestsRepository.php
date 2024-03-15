<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz\Test;
use App\Models\Quiz\TestUsersTests;
use App\Models\Users\User;
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
            'search' => null,
            'start_date' => null,
            'end_date' => null,
        ], $params);

        $result = TestUsersTests::select(
            TestUsersTests::TABLE.'.*',
            User::TABLE.'.name',
            User::TABLE.'.email as email',
            User::TABLE.'.phone',
            User::TABLE.'.username',
            User::TABLE.'.status'
        );

        $result->leftJoin(User::TABLE, TestUsersTests::TABLE . '.user_id', '=', User::TABLE . '.id');

        if (!empty($params['search'])) {
            $sql = "(" . User::TABLE . ".name LIKE '%" . $params['search'] . "%' OR " . User::TABLE . ".email LIKE '%" . $params['search'] . "%')";
            $result->whereRaw($sql);
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(TestUsersTests::TABLE.'.status', $params['status']);
        }

        if ( !empty($params['start_date']) && empty($params['end_date']) ) {
            $startDate = date('Y-m-d', strtotime($params['start_date']));
            $result->whereDate(TestUsersTests::TABLE . '.created_at', '>=', $startDate);
        }

        if ( empty($params['start_date']) && !empty($params['end_date']) ) {
            $endDate = date('Y-m-d', strtotime($params['end_date']));
            $result->whereDate(TestUsersTests::TABLE . '.created_at', '=', $endDate);
        }

        if ( !empty($params['start_date']) && !empty($params['end_date']) ) {
            $startDate = date('Y-m-d', strtotime($params['start_date']));
            $endDate = date('Y-m-d', strtotime($params['end_date']));
            $result->whereDate(TestUsersTests::TABLE . '.created_at', '>=', $startDate)->whereDate(TestUsersTests::TABLE . '.created_at', '<=', $endDate);
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
