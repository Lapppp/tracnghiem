<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPartUser extends Model
{
    use HasFactory;
    const TABLE = 'test_part_user';
    protected $table = self::TABLE;
    protected $fillable = [
        'test_id',
        'part_id',
        'question_id',
        'answer_id',
        'is_correct',
        'user_chosen',
        'user_id',
    ];

    public static function checkUserTestEnglishPart($params = [])
    {
        return self::where('test_id',$params['test_id'])
            ->where('part_id',$params['part_id'])
            ->where('question_id',$params['question_id'])
            ->where('answer_id',$params['answer_id'])
            ->where('user_id',$params['user_id'])
            ->first();
    }

    public static function checkUserTestPart($params = [])
    {
        return self::where('test_id',$params['test_id'])
            ->where('part_id',$params['part_id'])
            ->where('question_id',$params['question_id'])
            ->where('user_id',$params['user_id'])
            ->first();
    }
}
