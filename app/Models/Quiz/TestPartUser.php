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
}
