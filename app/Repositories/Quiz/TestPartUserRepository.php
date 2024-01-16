<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz\TestPartUser;
use Prettus\Repository\Eloquent\BaseRepository;

class TestPartUserRepository extends BaseRepository
{

    public function model()
    {
        return TestPartUser::class;
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

        $result = TestPartUser::select(
            TestPartUser::TABLE . '.*'
        );

        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function checkUserTestEnglishPart($params = [])
    {
        return TestPartUser::where('test_id',$params['test_id'])
            ->where('part_id',$params['part_id'])
            ->where('question_id',$params['question_id'])
            ->where('answer_id',$params['answer_id'])
            ->where('user_id',$params['user_id'])
            ->first();
    }

    public function checkUserTestPart($params = [])
    {
        return TestPartUser::where('test_id',$params['test_id'])
            ->where('part_id',$params['part_id'])
            ->where('question_id',$params['question_id'])
            ->where('user_id',$params['user_id'])
            ->first();
    }

    /**
     * Tổng số câu đúng
     * @param $test_id
     * @return mixed
     */
    public function totalTestPart($test_id)
    {
        return TestPartUser::where('test_id',$test_id)
            ->whereRaw('is_correct = user_chosen')
            ->selectRaw("COUNT(*) as total")
            ->groupBy('test_id')
            ->first();
    }

    /**
     * Tổng số câu
     * @param $test_id
     * @return mixed
     */
    public function totalAllTestPart($test_id)
    {
        $part =  TestPartUser::where('test_id',$test_id)
            ->selectRaw("COUNT(*) as total")
            ->groupBy('test_id')
            ->first();

        return $part->total ?? 0;
    }

    public function getById($id)
    {
        return TestPartUser::find($id);
    }
}
